<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserAdminController extends Controller
{
    public function __construct(
        protected User $repository,
        protected Role $roleRepository,
    ) {}

    public function index()
    {
        $users = $this->repository->paginate();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->roleRepository->all();
        $rolesAssign = [];
        return view('admin.users.create', compact('roles', 'rolesAssign'));
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $data = $request->all();
            $user = $this->repository->create($data);
            $user->syncRoles($data['roles'] ?? []);
            return redirect()->route('admin.users.index')->with('success', __('Insert with success'));
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', __('Error, try again.'));
        }
    }

    public function edit($id)
    {
        if(!$user = $this->repository->find($id)) {
            return redirect()->route('admin.users.index')->with('error', __('Item not founded'));
        }
        $roles = $this->roleRepository->all();
        $rolesAssign = $user->roles()->pluck('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'rolesAssign'));
    }

    public function update(Request $request, $id)
    {
        if(!$user = $this->repository->find($id)) {
            return redirect()->route('admin.users.index')->with('error', __('Item not founded'));
        }
        $data = $request->all();
        if(empty($data['password'])) unset($data['password']);
        $user->update($data);
        $user->syncRoles($data['roles'] ?? []);
        return redirect()->route('admin.users.index')->with('success', __('Edited'));
    }

    public function destroy($id)
    {
        try {
            if(!$user = $this->repository->findOrFail($id)) {
                throw new \Exception('Item not founded', 404);
            }
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', __('Deleted with success'));
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', __('Error, try again. '.$e->getMessage()));
        }
    }
}

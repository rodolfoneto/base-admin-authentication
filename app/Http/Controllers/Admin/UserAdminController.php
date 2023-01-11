<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function __construct(protected User $repository)
    {}

    public function index()
    {
        $users = $this->repository->paginate();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $this->repository->create($request->all());
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
        return view('', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if(!$user = $this->repository->find($id)) {
            $user->update($request->all());
        }
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

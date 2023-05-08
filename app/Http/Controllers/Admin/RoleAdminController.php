<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\{
    Permission,
    Role,
};
use Throwable;

class RoleAdminController extends Controller
{

    public function __construct(
        protected Role $repository,
        protected Permission $permissionRepository,
    ) {}

    public function index()
    {
        $roles = $this->repository->paginate();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function show($id)
    {
        $role = $this->repository->findOrFail($id);
        $permissionAssigned = $role->permissions()->pluck('id')->toArray();
        $permissions = $this->permissionRepository->all();
        return view(
            view: 'admin.roles.show',
            data: compact('role', 'permissionAssigned', 'permissions'),
        );
    }

    public function store(Request $request)
    {
        try {

            $this->repository->create($request->all());
            return redirect()
                ->route('admin.roles.index')
                ->with([
                    'sucess' => sprintf('%s $s', __('Role'), __("created with success"))
                ]);
        } catch (Throwable $th) {
            return redirect()
                ->route('admin.roles.index')
                ->with([
                    'error' => sprintf('%s', $th->getMessage()),
                ]);
        }
    }

    public function syncPermissions(Request $request, $id)
    {
        $role = $this->repository->findOrFail($id);
        $role->syncPermissions($request->only('permissions'));
        return redirect()
            ->route('admin.roles.show', $role->id)
            ->with(['success' => 'Permissões adicionadas com sucesso']);
    }

    public function destroy($id)
    {
        if(!$role = $this->repository->find($id)) {
            redirect()->route('admin.roles.index')->with(['error' => 'not founded']);
        }
        $role->delete();
        return redirect()->route('admin.roles.index')->with([
            'success' => sprintf('%s %s', __('Role'), 'excluded'),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionAdminController extends Controller
{
    public function __construct(
        protected Permission $repository
    ) {}

    public function index()
    {
        $permissions = $this->repository->paginate();
        return view(
            view: 'admin.permissions.index',
            data: compact('permissions')
        );
    }

    public function create()
    {
        return view(view: 'admin.permissions.create');
    }

    public function store(Request $request)
    {
        $this->repository->create($request->all());
        return redirect()
            ->route('admin.permissions.index')
            ->with([
                'success' => sprintf('%s %s', __('Permission'), 'created with success'),
            ]);
    }

    public function destroy($id)
    {
        if(!$role = $this->repository->find($id)) {
            redirect()->route('admin.permissions.index')->with(['error' => 'not founded']);
        }
        $role->delete();
        return redirect()->route('admin.permissions.index')->with([
            'success' => sprintf('%s %s', __('Permission'), 'excluded'),
        ]);
    }
}

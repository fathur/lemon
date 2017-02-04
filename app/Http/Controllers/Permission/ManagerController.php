<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->grant('view-permission-manager');

        $roles = Role::orderBy('id')->get();

        return view('permission.manage.index', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function manage(Request $request)
    {
        $this->grant('edit-permission-manager');

        $permissionId = $request->get('permission');
        $roleId = $request->get('role');

        $permission = Permission::find($permissionId);

        $pgCount = \DB::table('role_permission')
            ->select('*')
            ->where('permission_id', $permissionId)
            ->where('role_id', $roleId)
            ->count();

        if ($pgCount == 0) {
            $permission->roles()->attach($roleId);

            $checked = true;
            $status = 'success';
        } elseif ($pgCount == 1) {
            $permission->roles()->detach($roleId);

            $checked = false;
            $status = 'success';
        } else {
            $checked = false;
            $status = 'fail';
        }

        return response()->json([
            'checked' => $checked,
            'status'  => $status
        ]);
    }

    /**
     * @return mixed
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function data()
    {
        $this->grant('view-permission-manager');

        $pgHolder = [];

        $permissions = new Collection();

        $roles = Role::orderBy('id')->get();

        $pgCollection = \DB::table('role_permission')
            ->select('*')
            ->get();

        foreach ($pgCollection as $item) {
            array_push($pgHolder, $this->relatePermissionRole($item->permission_id, $item->role_id));
        }

        foreach (Permission::all() as $permission) {
            $pushData = [
                'permission' => $permission->name
            ];

            foreach ($roles as $role) {
                if (in_array($this->relatePermissionRole($permission->id, $role->id), $pgHolder)) {
                    $checkbox = '<input onclick="manageRole.change(this)" type="checkbox" checked="checked" ' .
                        'value="1" data-permission="' . $permission->id . '" data-role="' . $role->id . '">';
                } else {
                    $checkbox = '<input onclick="manageRole.change(this)" type="checkbox" value="1" ' .
                        'data-permission="' . $permission->id . '" data-role="' . $role->id . '">';
                }

                $pushData["role-{$role->id}"] = $checkbox;
            }

            $permissions->push($pushData);
        }

        return \Datatables::of($permissions)
            ->make(true);
    }

    /**
     * @param $permission
     * @param $role
     *
     * @return string
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    private function relatePermissionRole($permission, $role)
    {
        return "$permission-$role";
    }
}

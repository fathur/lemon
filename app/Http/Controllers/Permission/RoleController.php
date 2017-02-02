<?php

namespace App\Http\Controllers\Permission;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    private $rules = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->grant('view-role');

        return view('permission.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->grant('create-role');

        return view('permission.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->grant('create-role');

        \Validator::make($request->all(), $this->rules)
            ->validate();

        $role = new Role();
        $role->name = $request->get('name');
        $role->slug = Str::slug($request->get('name'));
        $role->save();

        return redirect()->route('roles.index')
            ->with('success', 'Role ' . $request->get('name') . ' successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role $role
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->grant('edit-role');

        return view('permission.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Role                $role
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->grant('edit-role');

        \Validator::make($request->all(), $this->rules)
            ->validate();

        $role->name = $request->get('name');
        $role->save();

        return redirect()->back()
            ->with('success', 'User ' . $request->get('name') . ' successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role $role
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

        $this->grant('delete-role');

        return Role::destroy($role->id);
    }

    /**
     * @return mixed
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function data()
    {
        $this->grant('view-role');

        return \Datatables::of(Role::select('*'))
            ->addColumn('action', function ($role) {
                return view('layouts.actions.1')
                    ->with('action', [
                        'name'    => $this->name,
                        'edit'    => route('roles.edit', $role->id),
                        'destroy' => route('roles.destroy', $role->id)
                    ])
                    ->with('ability', [
                        'edit'   => 'edit-role',
                        'delete' => 'delete-role'
                    ])
                    ->render();
            })
            ->make(true);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function select(Request $request)
    {
        $this->grant('create-user');

        $q = strtolower($request->get('q'));

        return Role::select(['id', 'name'])
            ->whereRaw("LOWER(name) LIKE '%$q%'")
            ->get();
    }
}

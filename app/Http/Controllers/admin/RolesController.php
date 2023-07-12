<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr['roles'] = Role::all();
        return view('admin/roles/index')->with($arr);  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Role::create(['name' => $request->name]);
        return redirect(route('admin.roles.index'));  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $arr['role'] = $role;
        $arr['permissions'] = Permission::all();
        return view('admin/roles/edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permission);
        return redirect(route('admin.roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
        return redirect(route('admin.roles.index'));
    }
}

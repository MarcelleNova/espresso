<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    } 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr['permissions'] = Permission::all();
        return view('admin/permissions/index')->with($arr);
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
        Permission::create(['name' => $request->name]);
        return redirect(route('admin.permissions.index')); 
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permission::destroy($id);
        return redirect(route('admin.permissions.index')); 
    }
}

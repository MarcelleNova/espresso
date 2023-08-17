<?php

namespace App\Http\Controllers\calls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\SaicomDataTable;
use App\Models\Calls\PhonesMovement;
use Yajra\DataTables\Facades\DataTables;

class SaicomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SaicomDataTable $dataTable)
    {
        return $dataTable->render('calls.saicom.index');
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
        //
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
        //
    }
}

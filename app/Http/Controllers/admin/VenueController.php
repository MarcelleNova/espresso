<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Venue;
use Illuminate\Http\Request;
use App\DataTables\VenueDataTable;
use App\Http\Controllers\Controller;

class VenueController extends Controller
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
        $arr['venues'] = Venue::all();
        return view ('admin/venues/index')->with($arr);
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
        // dd($request);
        Venue::create(['code' => $request->code, 'name' => $request->name, 'description' => $request->description]);
        return redirect(route('admin.venues.index')); 
    }   

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {
        $arr['venue'] = $venue;
        return view ('admin/venues/edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        $venue->name = $request->name;
        $venue->description = $request->description;
        $venue->code = $request->code;
        $venue->save();
        return redirect(route('admin.venues.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Venue::destroy($id);
        return redirect(route('admin.venues.index'));
    }

    public function getVenues(Request $request)
    {
        $data = Venue::select('name')->get();
        $venues = array();
        foreach ($data as $d) {
            $sub['id'] = $d->id;
            $sub['text'] = $d->name;
            $venues[] = $sub;
        }
        return ['results' => $venues];
    }
}

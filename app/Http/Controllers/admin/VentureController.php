<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\admin\Venture;
use App\Http\Controllers\Controller;

class VentureController extends Controller
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
        $arr['ventures'] = Venture::all();
        return view ('admin/ventures/index')->with($arr);
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
        Venture::create(['code'=> $request->code, 'name' => $request->name, 'description' => $request->description]);
        return redirect(route('admin.ventures.index'));
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
    public function edit(Venture $venture)
    {
        $arr['venture'] = $venture;
        return view ('admin/ventures/edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venture $venture)
    {
        $venture->code = $request->code;
        $venture->name = $request->name;
        $venture->description = $request->description;
        $venture->save();
        return redirect(route('admin.ventures.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Venture::destroy($id);
        return redirect(route('admin.ventures.index'));
    }

    public function getVentures(Request $request)
    {

        $data = Venture::select('name')->orderBy('name')
            ->get();
        // dd($data);
        $ventures = array();
        foreach ($data as $d) {
            $sub['id'] = $d->id;
            $sub['text'] = $d->name;
            $sub['code']= $d->code;
            $ventures[] = $sub;
        }
        return ['results' => $ventures];
    }
}

<?php

namespace App\Http\Controllers\calls;

use Carbon\Carbon;
use App\Models\admin\Venue;
use App\Models\Calls\Phones;
use App\Repositories\Bitrix;
use Illuminate\Http\Request;
use App\Models\admin\Venture;
use App\DataTables\PhonesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Calls\PhonesMovement;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PhonesMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PhonesDataTable $dataTable)
    {
        // return view()
        return $dataTable->render('calls.phones.index');
    }

    public function indexTable(PhonesDataTable $dataTable)
    {
        // return view()
        return $dataTable->render('calls.phones.indexTable');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function job(PhonesMovement $job)
    {
        //
    }

    public function doTSRUpdate(Request $request)
    {
        $user = Bitrix::findUser($request->newTSRUser);
        $movements = PhonesMovement::where('phoneID', $request->phone)->orderBy('assigned_date', 'desc')->first();
        $newMove = $movements->replicate();
        $newMove->assigned_date = Carbon::now();
        $newMove->assignedToUserID = $request->newTSRUser;
        $newMove->assignedToUserName = $user->NAME.' '.$user->LAST_NAME;
        $newMove->movedByUserID = Auth::user()->id;
        $newMove->created_at = Carbon::now();
        $newMove->save();

        $movements->active = '0';
        $movements->removed_date = Carbon::now();
        $movements->movedByUserID = Auth::user()->id;
        $movements->save();

        return redirect()->back();
    }


    public function doExtensionUpdate(Request $request)
    {
        $user = Bitrix::findUser($request->newTSRUser);
        $movements = PhonesMovement::where('phoneID', $request->phone)->orderBy('assigned_date', 'desc')->first();
        $newMove = $movements->replicate();
        $newMove->assigned_date = Carbon::now();
        $newMove->assignedToUserID = $request->newTSRUser;
        $newMove->assignedToUserName = $user->NAME.' '.$user->LAST_NAME;
        $newMove->movedByUserID = Auth::user()->id;
        $newMove->created_at = Carbon::now();
        $newMove->venture = $request->venture;
        $newMove->venue = $request->venue;
        $newMove->site = $request->site;
        $newMove->save();

        $movements->active = '0';
        $movements->removed_date = Carbon::now();
        $movements->movedByUserID = Auth::user()->id;
        $movements->save();

        $phone = Phones::find($request->phone);
        $phone->displayName = $request->displayName;
        $phone->save();

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
        return 'Store';
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $job = PhonesMovement::find($id);
        $arr['job'] = $job;
        return view('calls/phones/show')->with($arr);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhonesMovement $phonesMovement)
    {
        //
    }

    public function editPhone(Request $request)
    {
        $phonesAll = PhonesMovement::where('phoneID',$request->phone)->with('phone')->with('venture')->with('venue')->with('user')->orderBy('assigned_date','desc')->get();
        $arr['phones'] = $phonesAll;
        $active = PhonesMovement::where('phoneID',$request->phone)->with('phone')->with('venture')->with('venue')->with('user')->where('active','1')->first();
        $arr['active'] = $active;
        $arr['venues'] = Venue::select('id','name')->get();
        $arr['ventures'] = Venture::select('id','name')->get();
        // dd($arr);
        return view('calls.phones.edit')->with($arr);
        // return 'Yes';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PhonesMovement $phonesMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhonesMovement $phonesMovement)
    {
        //
    }

    public function autocompleteExt(Request $request)
    {

        $data = PhonesMovement::where('saicomUsername', 'LIKE', '%' . $request->input('q', '') . '%')
            ->get();
    
        $phone = array();
        foreach ($data as $d) {

                $sub['id'] = $d->id;
                $sub['text'] = $d->saicomUsername . ',   ' . $d->site. '   ' . $d->displayName;
                // $sub['text'] = $d->saicomUsername;
                $phone[] = $sub;

        }
        return ['results' => $phone];
    }
    
    public function autocompleteName(Request $request)
    {

        $data = PhonesMovement::where('displayName', 'LIKE', '%' . $request->input('q', '') . '%')
            ->get();

        $phone = array();
        foreach ($data as $d) {

                $sub['id'] = $d->id;
                $sub['text'] = $d->displayName. '   '. $d->site. '  '. $d->saicomUsername;
                $phone[] = $sub;

        }
        return ['results' => $phone];
    }
    public function getPhones(Request $request)
    {

        $data = PhonesMovement::select('displayName')->distinct()->orderBy('displayName')
            ->get();
        // dd($data);
        $phones = array();
        foreach ($data as $d) {
            $sub['id'] = $d->id;
            $sub['text'] = $d->displayName;
            $phones[] = $sub;
        }
        return ['results' => $phones];
    }

}

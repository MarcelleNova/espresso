<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\BitrixUsers;
use Illuminate\Support\Facades\Auth;

class BitrixUserController extends Controller
{
    public function index()
    {
    //     $companyID = Auth::user()->companyID;
    //     if(Auth::user()->hasRole('Super Admin')){
    //          $arr['users'] = BitrixUsers::all();
    //     }
    //    dd($arr['users']);

       $man = BitrixUsers::find('1');
       dd($man);
       
        // return view('admin.users.index')->with($arr);
    }


    public function getActiveUsers(Request $request)
    {

        // $data = Phones::select('extension','displayName')->distinct()->orderBy('extension')->get();
        $data = BitrixUsers::where('NAME','LIKE', '%' . $request->input('q', '') . '%' )->where('ACTIVE','Y')->get();
        // dd($data);
        $users = array();
        foreach ($data as $d) {
            $sub['id'] = $d->ID;
            $sub['text'] = $d->NAME.'   '.$d->LAST_NAME;
            $users[] = $sub;
        }
        return ['results' => $users];
    }


}

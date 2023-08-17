<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\admin\Company;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Notifications\DailyCallImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $companyID = Auth::user()->companyID;
        if(Auth::user()->hasRole('Super Admin')){
             $arr['users'] = User::all();
        }
        else{
            $arr['users'] = User::where('companyID', $companyID)->get();
            $arr['users'] = User::all();
        }
       
        return view('admin.users.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->hasRole('Super Admin'))
        {
            $arr['companies'] = Company::all();
            $arr['roles'] = Role::all()->pluck('name');
            // $arr['reports'] = Reports::all()->pluck(['id', 'name']);
        }
        else
        {
            $companyID = Auth::user()->companyID;
            $arr['companies'] = Company::where('id', $companyID)->get();
            $arr['roles'] = Auth::user()->roles->pluck('name');
        }
        return view('admin.users.create')->with($arr);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        if(Auth::user()->hasRole('Super Admin'))
        {
            $companyID = $request->companyID;    
        }
        else
        {
            $companyID = Auth::user()->companyID; 
        }
         $user->companyID = $companyID;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->mobile = $request->mobile;
         $user->password =  Hash::make("password");
         $user->save();
         $user->syncRoles($request->roles);
        //  $user->reports()->sync($request->reports);

         return redirect(route('admin.users.index'));
    }

    public function search(Request $request)
    {

        $data = User::where('name', 'LIKE', '%'.$request->input('q', '').'%')
                ->where('companyID', Auth::user()->companyID)
                ->get();
        //dd($data);
        $val = array();
        foreach($data as $d){
          $sub['id'] = $d->id;
          $sub['text'] = $d->name;
          $val[] = $sub;
          
        }
        return ['results' => $val];
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return(json_encode($user));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $arr['user'] = $user;
        if(Auth::user()->hasRole('Super Admin'))
        {
            $arr['roles'] = Role::all()->pluck('name');
            // $arr['reports'] = Reports::all()->sortBy(['category','name']);
        }
        else
        {
            $arr['roles'] = $user->getRoleNames();
        }
        
        //print_r($arr);
        return view('admin.users.edit')->with($arr);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        // $user->bpmID = $request->bpmID;
        $user->save();
        $user->syncRoles($request->roles);
        // $user->reports()->sync($request->reports);
        return redirect(route('admin.users.index'));   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);    
        return redirect(route('admin.users.index')); 
    }

    public function getBitrixUsers(Request $request)
    {

        $data = Venture::select('name')->orderBy('name')
            ->get();
        // dd($data);
        $ventures = array();
        foreach ($data as $d) {
            $sub['id'] = $d->id;
            $sub['text'] = $d->name;
            $ventures[] = $sub;
        }
        return ['results' => $ventures];
    }

    public function email(Request $request)
    {
        $user = Auth::user();
        $user->notify(new DailyCallImport());
       
    }
}

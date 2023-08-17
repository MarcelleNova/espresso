<?php

namespace App\Http\Controllers\calls;

use App\Models\admin\Venue;
use App\Models\Calls\Phones;
use Illuminate\Http\Request;
use App\Models\admin\Company;
use App\Models\admin\Venture;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\admin\BitrixUsers;
use App\Models\Calls\PhonesMovement;
use Illuminate\Support\Facades\Auth;
use App\Models\Calls\temp_phone_movements;
use App\Models\calls\tempExtension;

class PhoneMasterController extends Controller
{
    //Once Off populate
    public function populate()
    {
        
        $data = Phones::all();

        foreach($data as $d)
        {
            // dd($d->saicomUsername);
            // $match = temp_phone_movements::where('saicomUsername', $d->saicomUsername)->first();


            $extension = substr($d->saicomUsername,6,4);
            
            $d->extension = $extension;
            $d->save();
            // dd($match, $d);
            // if (isset($match)){
            //     $d->displayName = $match->displayName;
    
            //     $d->save();
            // }
          
        }

        return ('Done');
    }

    public function populateMovement()
    {
        
        $data = Phones::all();

        foreach($data as $d)
        {
            // dd($d->saicomUsername);
            $match = temp_phone_movements::where('saicomUsername', $d->saicomUsername)->get();

            foreach( $match as $m)
            {
                $company = Company::where('companyName','like', $m->company)->first();
                $venture = Venture::where('name','like',  $m->venture)->first();
                $venue = Venue::where('name','like', $m->venue)->first();

                // dd($company, $venue, $venture);
                if (isset($venture) && isset($venue) && isset($company))
                { 
                    if((isset($m->assigned_date) && $m->assigned_date != '0000-00-00') ? $validAssignedDate = $m->assigned_date : $validAssignedDate = NULL );
                    if((isset($m->removed_date) && $m->removed_date != '0000-00-00')? $validRemovedDate = $m->removed_date : $validRemovedDate = NULL );

                    PhonesMovement::create([
                        'phoneID' => $d->id,
                        'active' => $m->active,
                        'assigned_date' => $validAssignedDate,
                        'removed_date' =>  $validRemovedDate,
                        'company' => $company->id,
                        'site' => $m->site,
                        'venue' => $venue->id,
                        'venture' => $venture->id,
                        'phoneCategory' => $m->phoneCategory,
                        'employmentType' => $m->employmentType,
                        'assignedToUserID' => $m->assignedToUserID,
                        'assignedToUserName' => $m->assignedToUserName,
                        'movedByUserID' => Auth::user()->id,
                        'note'=>$m->note
                    ]);
                } else {
                    // dd($m);
                }
            }
          
        }

        return ('Done');
    }

    public function populateExtension()
    {
        $data =  Phones::all();
        foreach ($data as $index=>$d)
        {
            $active = PhonesMovement::where('active','1')->where('phoneID',$d->id)->first();

            $extension = tempExtension::where('extension', $d->extension)->first();

       
            if ($extension && $active) {
                $bitrixName = explode(" ",$extension->bitrix_full_name);
                $bitrixLastName = str_replace($bitrixName[0],'',$extension->bitrix_full_name);
                // dd($bitrixLastName);
                // $bitrixUser = BitrixUsers::where(['NAME','LIKE',$bitrixName[0],
                //     'LAST_NAME','LIKE',$bitrixLastName])->first();  
                    $bitrixUser = BitrixUsers::where('NAME','LIKE',$bitrixName[0])
                 ->first();  
                if ($bitrixUser) {
                    $active->assignedToUserID = $bitrixUser->ID;
                    $active->assignedToUserName = $bitrixUser->NAME.' '.$bitrixUser->LAST_NAME;
                    $active->note = "Bitrix User Updated by Extension Population";
                    $active->save();
                    // dump($d->id, $active->id, $extension->bitrix_full_name, $bitrixUser->NAME, $bitrixUser->LAST_NAME);
                }
                
            } 
           
        }

    }

    public function getPhones(Request $request)
    {

        $data = Phones::select('displayName')->distinct()->orderBy('displayName')
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

    public function getPhoneExtensions(Request $request)
    {

        // $data = Phones::select('extension','displayName')->distinct()->orderBy('extension')->get();
        $data = Phones::where('extension','LIKE', '%' . $request->input('q', '') . '%' )->get();
        // dd($data);
        $phones = array();
        foreach ($data as $d) {
            $sub['id'] = $d->id;
            $sub['text'] = $d->extension.'   '.$d->displayName;
            $phones[] = $sub;
        }
        return ['results' => $phones];
    }

    public function autocompleteName(Request $request)
    {

        $data = Phones::where('displayName', 'LIKE', '%' . $request->input('q', '') . '%')
            ->get();
        //dd($data);
        $phone = array();
        foreach ($data as $d) {

                $sub['id'] = $d->id;
                $sub['text'] = $d->displayName. '    ---    '.$d->saicomUsername;
                $phone[] = $sub;

        }
        return ['results' => $phone];
    }
}

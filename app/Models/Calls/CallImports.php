<?php

namespace App\Models\Calls;

use DateTime;
use Exception;
use Carbon\Carbon;
use App\Models\admin\Venue;
use App\Models\Calls\Saicom;
use App\Models\admin\Venture;
use App\Models\calls\CallData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Calls\PhonesMovement;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\IsTrue;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CallImports extends Model
{
    use HasFactory;
    // protected $fillable = ['startTime','groupName','UserID','fromNumber','dialedNumber','answered','answerTie','ReleaseTime'];
    protected $guarded =[];

    public $totalCount = 0; 

    public $keepThese = ['NL - Permissions Potch', 'NL Potch IG' ,'NL Potch TBF','NL Potch THG','NL Potch Training','NL WR IG','NL WR Training','Nova Life - Potchefstroom Forum Building', 'te1006500'];
    
    public $destroyThese = ['Platinum Life - Illovo', 'Platinum Life - Roodepoort', 'Platinum Life - Pretoria Lead Generation', 'Platinum Life - Centurion', 'Platinum Life - Potchefstroom Trust Building','The Box Fashion',  'Nova Life - Roodepoort', 'te1006112','te1006647' ];

    public function __construct() {
    
    }

    public function importToDB()
    {
        
        set_time_limit(0);
        ini_set('memory_limit', '2048M'); 

        DB::table('saicoms')->whereIn('groupName', $this->destroyThese)->delete();

        Saicom::chunk(1000, function ($data) {
            
            $recordCount = 0;
            $novaCount = 0;
            $writeCount = 0;
            foreach ($data as $d)
            {
                $recordCount++;
                //Filter out from Platinum Life Only Nova Calls
                if(in_array($d->groupName, $this->keepThese))
                {
                    $novaCount++;
                    $dateTime = Carbon::createFromFormat('YmdHis.u',$d->startTime);
                    $nextMonth = Carbon::createFromFormat('YmdHis.u',$d->startTime)->addMonthsNoOverflow(1);;

                    $phone = PhonesMovement::where('saicomUsername',$d->userID)->where('assigned_date', '<=', $dateTime)->where('removed_date',['>=',$dateTime||'=','0000-00-00'])->first();
                    // dd($phone);
                    if (ISSET($phone)) {
                        // Venue is derived from Phone, so all good. If Not try and derive it
                        // Log::debug('Phone matched'.$d->groupName);
                    } else {
                        
                        // Get Venue
                        if(str_contains($d->groupName,'Potch')){
                            $venue =  Venue::select('name')->where('name','POTCH')->first();
                        } else if(str_contains($d->groupName,'WR')) {
                            $venue = Venue::select('name')->where('name','WR')->first();
                        } else if(str_contains($d->groupName,'te1')) {
                            $venue = Venue::select('name')->where('name','Kathu')->first();
                        } else{
                            $venue = '';
                        } 

                        // //Get Venture
                        if (str_contains($d->groupName,'IG') || str_contains($d->groupName,'te1006500')){
                            $venture = Venture::select('name')->where('name','IG')->first();
                        } else if(str_contains($d->groupName, 'TBF')){
                            $venture = Venture::select('name')->where('name','TBF')->first();
                        } else if ((str_contains($d->groupName, 'THG') || str_contains($d->groupName, 'THGLG'))) {
                            $venture = Venture::select('name')->where('name','THG')->first();
                        } else if(str_contains($d->groupName,'Training')) {
                            $venture = Venture::select('name')->where('name','TRAINING')->first();
                        } else if(str_contains($d->groupName, 'ALL')) {
                            $venture = Venture::select('name')->where('name','ALL')->first();
                        } else if (str_contains($d->groupName, 'LG')) {
                            $venture = Venture::select('name')->where('name','LG')->first();
                        } else if (str_contains($d->groupName, 'LG')) {
                                $venture = Venture::select('name')->where('name','LG')->first();
                        } else {
                            $venture = '';
                        }
                        Log::error('Phone not in Phone Movements Table, manually matched. '.$d->userID.' '. $d->groupName.' Matched to: '.$venue.' '.$venture);
                    }

                    if (ISSET($phone->venture) && ISSET($phone->venue) || ( $venture !=='' && $venue !=='')) {
                        try{
                         
                            // dd($phone);
                            $call = CallData::create();  
                                    $call->callMonth = $dateTime->startOfMonth();
                                    $call->salaryMonth = $nextMonth->startOfMonth();
                                   
                                    if (isset($phone->venue) && isset($phone->venture)){
                                        $call->phoneID = $phone->id;
                                        $call->venue = $phone->venue;
                                        $call->venture = $phone->venture;
                                        $call->extensionName = $phone->displayName;
                                        $call->company = $phone->company;
                                    } else {
                                        $call->venue = $venue->name;
                                        $call->venture = $venture->name;
                                    }
                                    $call->date = Carbon::createFromFormat('YmdHis.u',$d->startTime);
                                    $call->time = Carbon::createFromFormat('YmdHis.u',$d->startTime);
                                    // Calculate Duration Times
                                    if ($d->answered == 'Yes') {               
                                        $startTime = Carbon::parse(Carbon::createFromFormat('YmdHis.u',$d->startTime)->toDateTimeString());
                                        $answerTime = Carbon::parse(Carbon::createFromFormat('YmdHis.u',$d->answerTime)->toDateTimeString());
                                        $releaseTime = Carbon::parse(Carbon::createFromFormat('YmdHis.u',$d->releaseTime)->toDateTimeString());
                                        $ringTime = Carbon::parse($answerTime->diffInSeconds($startTime));
                                        $duration = Carbon::parse($releaseTime->diffInSeconds($answerTime));
                                        $call->ringTime = $ringTime->toTimeString();
                                        $call->duration = $duration->toTimeString();
                                    } else {
                                        $call->ringTime = 0;
                                        $call->duration = 0;
                                    }

                                    $call->dialedNumber = $d->dialedNumber;
                                    
                                    if (str_contains($d->dialedNumber,'PORT')) {
                                        dump('PORT ', $d->dialedNumber);
                                        $d->dialedNumber = str_replace($d->dialedNumber, 'PORT-','');
                                        dump('PORT ', $d->dialedNumber);
                                    }

                                    if(strlen($d->dialedNumber)<10 && $duration->lt('00:00:10')){
                                            $call->dialType = 'MISSED DIAL';
                                    } else {
                                          $call->dialType = 'CONFIRMED DIAL';
                                    }
                
                                    $call->fromNumber = $d->fromNumber;
                                    $call->extension = substr($d->fromNumber, -4);
                                    $call->answered = $d->answered;

                            $call->save();
                            $writeCount++;
                            // Log::debug('Call Data written '.$d->groupName.' '.$d->userID.'Phone: '.$call->venueID.' '.$call->ventureID);
                        } catch(Exception $e)
                        {
                            Log::error('Call Data write failed  '.$d);
                            Log::error('Exception'.$e);
                            // dd($d, $dateTime->startOfMonth(), $nextMonth->startOfMonth(),  $venue,  $venture);
                        }
                    } else {
                        Log::error('Call Data write failed, matched failed  '.$d);
                    }
                }
            }
            Log::debug('Records Read: '.$recordCount.' Nova Calls: '.$novaCount.' Calls Written to DB: '.$writeCount);
            // dd('Stopped after 50');
        });
        // Log::debug('Total Count: '.$totalCount);
    }

}

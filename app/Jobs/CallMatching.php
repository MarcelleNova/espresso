<?php

namespace App\Jobs;

use DateTime;
use Exception;
use Carbon\Carbon;
use App\Models\Calls\Phones;
use Illuminate\Bus\Queueable;
use App\Models\calls\CallData;
use App\Models\Calls\CallFTPImport;
use Illuminate\Support\Facades\Log;
use App\Models\Calls\PhonesMovement;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CallMatching implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ini_set('max_execution_time', 1800);
        //Get All Calls not sent through Call Matching Engine yest
        // $data = CallFTPImport::chunk(1000)->where('process', 'YES')->get();

        CallFTPImport::where('process', 'YES')->chunk(1000, function($data) {

        foreach ($data as $index=>$d)
        {
            $workDate = new DateTime($d->callDate);
            $newDate = new Carbon($workDate);
            //Use Call Extension to find Venture Venue Company
            $phone = Phones::where('displayName', $d->extensionName)->with('movements')->first();
            //check if I make changes now what happens
            if (isset($phone)) {
                //Error check and write to log    
                
                // foreach ($phone->movement as $p)
                // {
                   
                    //Make sure to grab the correct movement according to call Date
                    foreach($phone->movements as $move)
                    {
                        if ($workDate <= $move->assigned_date && $workDate >= $move->removed_date)
                        {
                            $expired = $move;
                        }
                        if ($move->active == '1') {
                            $active = $move;
                        }
                    }

                    if (isset($expired->id)) 
                    { 
                        $active = $expired;
                    } 
                    
                    try {             
                        $record = new CallData();
                        $record->callMonth = $newDate->startOfMonth();
                        $record->phoneID = $phone->id;
                        $record->venue = $active->venue;
                        $record->venture = $active->venture;
                        $record->company = $active->company;
                        $record->date = $workDate;
                        $record->time =$d->callTime;
                        $record->ringTime = $this->convert($d->ringTime);
                        $record->duration = $this->convert($d->duration);
                
                        if(strlen($d->dialedNumber)<10 && intval($d->duration) < 10){ 
                            $record->dialType = 'MISSED DIAL';
                        } else {
                            $record->dialType = 'CONFIRMED DIAL';
                        }
                        $record->fromNumber = $d->fromNumber;
                        $record->extensionName = $d->extensionName;
                        $record->dialedNumber = $d->dialedNumber;
                        $record->answered = $d->answered;
                        $record->extension = substr($d->fromNumber, -4);
                        $record->cost = ($d->cost == null)? 0 : $d->cost;
                        $record->callHour = Carbon::parse($d->callTime)->hour;
                        $record->save();
                    }  catch (Exception $e) {
                    Log::debug('Valid call not written to Call Import file '.$e.$d->id);
                }
                
            } else {
                //If phone is not found, write to error file
                // dd('Write error');
                Log::debug('Call import not written to Call Data, Phone Extension not Matched'.$d->id.$d->extensionName);
            }
    
        }
        });
        
        
    }

    public function convert($iSeconds) {
        $seconds = $iSeconds % 60;
        $minutes = intval($iSeconds/60);
        $hours = intval($minutes/60);
        $minutes = $minutes % 60;
      
        return date('H:i:s', mktime($hours, $minutes, $seconds));
      }
}

<?php

namespace App\Jobs;

use Exception;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use App\Models\Calls\CallMiddayImport;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessMiddayDialImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file, $count, $unlink;
    /**
     * Create a new job instance.
     */
    public function __construct($file, $unlink)
    {
        $this->file = $file;
        $this->unlink = $unlink;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {   

            $dataAll = array_map('str_getcsv', file($this->file),[';']);
            $data = array_slice($dataAll, 1);
            foreach($data as $key=>$call)
            {
               
            try {
                if($call[3] == 'Yes') 
                {
                    CallMiddayImport::create(
                        ['callDate' => $call[0],
                        'callTime'=> $call[1],
                        'ringTime'=> $call[2],
                        'answered' =>$call[3],
                        'duration' => $call[4],
                        'accountCode' => $call[5],
                        'fromNumber' => $call[6],
                        'extensionName' => $call[7],
                        'dialedNumber' => $call[8], 
                        'destination' => $call[9],
                        'ported' => $call[10],
                        'cost' => $call[11],
                        'created_at'=> Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                } else {
                    CallMiddayImport::create(
                        ['callDate' => $call[0],
                        'callTime'=> $call[1],
                        'ringTime'=> $call[2],
                        'answered' =>$call[3],
                        'duration' => $call[4],
                        'accountCode' => $call[5],
                        'fromNumber' => $call[6],
                        'extensionName' => $call[7],
                        'dialedNumber' => $call[8], 
                        'created_at'=> Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
               
                       
            }  catch (Exception $e) {
                Log::debug('Valid call not written to Call Import file '.$e.$call[0].$call[1].$call[2].$call[3].$call[4].$call[5].$call[6].$call[7]);
            }
                
            }

        $data = null;
        if ($this->unlink) unlink($this->file);  
        
    }
}

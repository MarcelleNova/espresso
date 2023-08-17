<?php

namespace App\Jobs;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\File;
use App\Models\Calls\Saicom;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use App\Models\Calls\CallFTPImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessCsvUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public $file, $filename, $count, $unlink;

    public $keepThese = ['NG_Potch_Permissions', 'NL_Potch_IG' ,'NL_Potch_TBF','NL_Potch_THG','NL_Potch_Training','NL_WR_IG','NL_WR_Training','Potchefstroom_Forum_Building', 'NL_Kathu', 'Mobile_CLI'];
    /**
     * Create a new job instance.
     */
    public function __construct($file, $filename, $unlink)
    {
        $this->file = $file;
        $this->unlink = $unlink;
        $this->filename = $filename;

        // $this->count = $count;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {   
        //Determine if these records should be matched later on, All will be imported.
        $process = 'NO';
        foreach ($this->keepThese as $venture)
        {
            if (strpos($this->filename, $venture) >= 1) $process = 'YES';
        }

        $dataAll = array_map('str_getcsv', file($this->file),[';']);
        $data = array_slice($dataAll, 1);
        foreach($data as $key=>$call)
        { 
            try {
                if($call[3] == 'Yes') 
                {
                    CallFTPImport::create(
                        ['callDate' => $call[0],
                        'callTime'=> $call[1],
                        'ringTime'=> $call[2],
                        'answered' =>$call[3],
                        'duration' => $call[4],
                        'accountCode' => $call[5],
                        'fromNumber' => $call[6],   
                        'extensionName' => $call[7],
                        'dialedNumber' => $call[8], 
                        'destination' => $call[9],  // 
                        'ported' => $call[10],  //
                        'cost' => $call[11],    //
                        'fromFile' => $this->filename,
                        'process' => $process,
                        'created_at'=> Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                } else {
                    CallFTPImport::create(
                        ['callDate' => $call[0],
                        'callTime'=> $call[1],
                        'ringTime'=> $call[2],
                        'answered' =>$call[3],
                        'duration' => $call[4],
                        'accountCode' => $call[5],
                        'fromNumber' => $call[6],
                        'extensionName' => $call[7],
                        'dialedNumber' => $call[8], 
                        'fromFile' => $this->filename,
                        'process' => $process,
                        'created_at'=> Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
               
                       
            }  catch (Exception $e) {
                Log::debug('Valid call not written to Call Import file '.$e.$call[0].$call[1].$call[2].$call[3].$call[4].$call[5].$call[6].$call[7]);
            }
                
            }

        unset($data);
        unset($dataAll);
        if ($this->unlink) unlink($this->file);  
        
    }
}

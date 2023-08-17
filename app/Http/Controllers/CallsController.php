<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calls\CallImports;

class CallsController extends Controller
{

    public function chunk()   // This was moved to Zip Controller
    {
      
        request()->validate([
         'file'=> 'required|mimes:csv,txt'
        ]);
         

        if(request()->has('mycsv')){
            // $data = array_map('str_getcsv',file(request()->mycsv),[';']);
            $data = file(request()->mycsv);
            $header = $data[0];
            unset($data[0]);
        
            //Chunking file
            $chunks = array_chunk($data, 1000);
            //Convert 1000 records into a new csv file
            foreach ($chunks as $key => $chunk)
            {
                $storageDestinationPath= resource_path("pending-files/");
                if (!File::exists( $storageDestinationPath)) 
                {
                    \File::makeDirectory($storageDestinationPath, 0755, true);
                }
                $filename = resource_path('pending-files/'.date('y-m-d-H-i-s').$index. '.csv');
                file_put_contents($filename, $part);

              
            }


    } else {
        return back()
             ->with('warning','Please select a file.');
    }
 
    return 'Done';
    }

     public function store(Request $request) 
     {
 
        $path = resource_path('pending-files/*.csv');
        $g = glob($path);

        foreach (array_slice($g, 0, 1) as $file)
        {

            $data = array_map('str_getcsv', file($file),[';']);

            foreach($data as $key=>$row)
            {
                if($row[5] == 'Yes') {
                    $callData = CallImports::create([
                        'startTime' => $row[0],
                        'groupName'=> $row[1],
                        'userID'=> $row[2],
                        'fromNumber' =>$row[3],
                        'dialedNumber' => $row[4],
                        'answered' => $row[5],
                        'answerTime' => $row[6],
                        'releaseTime' => $row[7],
                        'terminationCause' => $row[8],
                        'trackingID' => $row[9],
                        'callID' => $row[10],
                        'groupNumber' => $row[11]]);
                } else {
                    $callData = CallImports::create([
                        'startTime' => $row[0],
                        'groupName'=> $row[1],
                        'userID'=> $row[2],
                        'fromNumber' =>$row[3],
                        'dialedNumber' => $row[4],
                        'answered' => $row[5],
                        // 'answerTime' => $row[6],
                        'releaseTime' => $row[7],
                        'terminationCause' => $row[8],
                        'trackingID' => $row[9],
                        'callID' => $row[10],
                        'groupNumber' => $row[11]]);
                }
            }
            unlink($file); 
        }
    }

}

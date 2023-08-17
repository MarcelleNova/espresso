<?php

namespace App\Http\Controllers\calls;

use File;
use ZipArchive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Calls\Saicom;

class ZipController extends Controller
{

    public function createJob(Request $request){
         
        return view("calls.saicom.unzipForm");
    }

    public function create() 
    {
        return view("calls.saicom.unzipForm");
    }


    public function store(Request $request) 
    {

        request()->validate([
            'file'=> 'required|mimes:csv,txt'
        ]);

        $file = file($request->file->getRealPath());
        $data = array_slice($file, 1);
        $count = 0;
        $parts = (array_chunk($data, 10000));

        $storageDestinationPath= resource_path("pending-files/");
        if (!File::exists( $storageDestinationPath)) {
            File::makeDirectory($storageDestinationPath, 0755, true);
        } 

        foreach($parts as $index=>$part){
                     $filename = resource_path('pending-files/'.date('y-m-d-H-i-s').$index. '.csv');
                     file_put_contents($filename, $part);
        }
        
        (new Saicom())->importToDB();
        
        // session()->flash('status','Queued for importing');
        // return redirect("calls/import");

        return back()
        ->with('success','Chunking CSV completed successfully, records imported');

    }



    function unzip(Request $request){
        //This method takes a zipped file and extract it to a specified directory 
        $zip = new ZipArchive();
        $status = $zip->open($request->file("zip")->getRealPath());
        if ($status !== true) {
         throw new \Exception($status);
        }
        else{
            $storageDestinationPath= public_path("app/uploads/unzip/");
       
            if (!File::exists( $storageDestinationPath)) {
                \File::makeDirectory($storageDestinationPath, 0755, true);
            }

            $zip->extractTo($storageDestinationPath);
            $zip->close();
            
            session()->flash('status','Zip file successfully extracted');

            return back()
             ->with('success','Zip extraction completed successfully.');
        }
    }


  

}

<?php

namespace App\Http\Controllers\calls;

use File;
use ZipArchive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ZipController extends Controller
{

    function createJob(Request $request){
         
        return view("calls.unzipForm");
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
       
            return back()
             ->with('success','You have successfully extracted zip.');
        }
    }

    
    // function importCalls(Request $request){
    //     //Reads the csv file and chunk it to a temporry
    //     request()->validate([
    //      'file'=> 'required|mimes:csv,txt'
    //     ]);
 
    //  //    $this->run();
 
    //     $this->store($request);
 
    //     return back()
    //     ->with('success','You have successfully imported');
 
    //  }


    //  public function store(Request $request) 
    //  {
    //      request()->validate([
    //          'file'=> 'required|mimes:csv,txt'
    //         ]);
 
    //      $file = file($request->file->getRealPath());
 
    //      $data = array_slice($file,1);
 
    //      $parts = (array_chunk($data, 1000));
 
    //      foreach($parts as $index=>$part){
    //         $storageDestinationPath= resource_path("pending-files/");
       
    //         if (!File::exists( $storageDestinationPath)) {
    //             \File::makeDirectory($storageDestinationPath, 0755, true);
    //         }
    //          $filename = resource_path('pending-files/'.date('y-m-d-H-i-s').$index. '.csv');
    //          file_put_contents($filename, $part);
    //      }
 
    //      session()->flash('status','Queued for importing');
 
    //      return back();

    //  }

}

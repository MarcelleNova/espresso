<?php

namespace App\Http\Controllers\calls;

use File;
use App\Jobs\CallMatching;
use Illuminate\Http\Request;
use App\Jobs\ProcessCsvUpload;
use App\Models\calls\CallData;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessMiddayDialImport;
use App\Models\Calls\CallMiddayImport;
use Illuminate\Support\Facades\Storage;

class CallDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('calls.calldata.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('calls.calldata.manualFull'); 
    }


    public function createmidday()
    {
        return view('calls.calldata.manualDaily'); 
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CallData $callData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CallData $callData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CallData $callData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CallData $callData)
    {
        //
    }

    public function match(Request $request)
    {
        CallMatching::dispatch();
    }


    public function import(Request $request)
    {
        //Do import for one file only
        if ($request->hasFile('csv_file')) {
        
            $csvFile = $request->file('csv_file'); 

           // Store the file in the 'storage' disk under 'csv' directory
           $path = $csvFile->store('csv', 'local');
        
           $fullPath = storage_path('app/'.$path);

           ProcessCsvUpload::dispatch($fullPath, true);
        }
        //Do import for a specific Date
        if ($request->date) {
            $directory = 'Full Day';
            $files = Storage::disk('local2')->files($directory);
      
            $filteredFiles = [];
            $desiredDate = $request->date;
    
            foreach ($files as $file) {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $filesize = Storage::disk('local2')->size($file);
                // Filter only for the date and a file with actual data in
                if (strpos($filename, $desiredDate) > 1 && $filesize > 110) {
                        $filteredFiles[] = $file;
                }
            }
    
            foreach ($filteredFiles as $f)
            {
                set_time_limit(0);
                ini_set('memory_limit', '2048M'); 
                $dataFile = Storage::disk('local2')->path($f);
                $filename = pathinfo($f, PATHINFO_FILENAME);
                ProcessCsvUpload::dispatch($dataFile, $f, false);
            }
     
        }
        return redirect(route('optimize-clear'));

        return back()
        ->with('success','Call import completed successfully.');

    }

    public function importmidday(Request $request)
    {
        DB::table('call_midday_imports')->delete();
            
        //Do import for one file only
        if ($request->hasFile('csv_file')) {
            $csvFile = $request->file('csv_file'); 
           // Store the file in the 'storage' disk under 'csv' directory
           $path = $csvFile->store('csv', 'local');
        
           $fullPath = storage_path('app/'.$path);
           ProcessMiddayDialImport::dispatch($fullPath, true);
        }

        //Do import for a specific Date
        if ($request->date) {
            $directory = 'Midday';
            $files = Storage::disk('local2')->files($directory);
      
            $filteredFiles = [];
            $desiredDate = $request->date;

          
            foreach ($files as $file) {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $filesize = Storage::disk('local2')->size($file);
                // Filter only for the date and a file with actual data in
                if (strpos($filename, $desiredDate) > 1 && $filesize > 110) {
                        $filteredFiles[] = $file;
                }
            }
    
            foreach ($filteredFiles as $f)
            {
                set_time_limit(0);
                ini_set('memory_limit', '2048M'); 
                $dataFile = Storage::disk('local2')->path($f);
                $filename = pathinfo($f, PATHINFO_FILENAME);
                ProcessMiddayDialImport::dispatch($dataFile, false);
            }
        }
        return redirect(route('optimize-clear'));
        return back()
        ->with('success','Call import completed successfully.');

    }

    public function data()
    {
    //    dd('Do day stats'); 

       $calls = DB::select("SELECT
            extensionName,
            count(call_midday_imports.callTime) as totalCalls,
            count(call_midday_imports.answered) as answeredCalls
            from call_midday_imports
            group By extensionName;
       ");

        $arr['labels'] = array();
        $arr['totals'] = array();
        $arr['answered'] = array();

        foreach ($calls as $key=>$c)
        {
            array_push($arr['labels'], $c->extensionName);
            array_push($arr['totals'], $c->totalCalls);
            array_push($arr['answered'], $c->answeredCalls);
        }
        // dd($arr);

        return (json_encode($arr));

    }


    public function dashboard() 
    {

        $arr['allCalls'] = CallMiddayImport::all();
        $arr['calls'] = CallMiddayImport::all()->groupBy('extensionName');
        $arr['answered'] = CallMiddayImport::where('answered', 'Yes')->get();

        return view('calls.calls_dashboard')->with($arr);
    }
}

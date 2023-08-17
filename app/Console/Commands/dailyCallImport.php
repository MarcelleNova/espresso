<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\File;
use App\Jobs\ProcessCsvUpload;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\DailyCallImport as NotificationsDailyCallImport;

class dailyCallImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-call-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This daily task checks the ftp directory from Saicom to import Daily Call data';

    /**
     * Execute the console command.
     */
    public function handle()
    { 
        $directory = 'Full Day';
        $files = Storage::disk('local2')->files($directory);
  
        $filteredFiles = [];
        $desiredDate = Carbon::yesterday()->format('Y-m-d');

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
            $dataFile = Storage::disk('local2')->path($f);
            $filename = pathinfo($f, PATHINFO_FILENAME);
            ProcessCsvUpload::dispatch($dataFile, $filename, false);
        }

        $user = User::where('name', 'SuperUser')->first();
        $user->notify(new NotificationsDailyCallImport());
        
        return redirect(route('optimize-clear'));
    }
}

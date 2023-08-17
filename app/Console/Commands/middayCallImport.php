<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessMiddayDialImport;
use Illuminate\Support\Facades\Storage;
use App\Notifications\MiddayCallImport as NotificationsMiddayCallImport;

class middayCallImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:midday-call-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This daily task checks the ftp directory from Saicom to import Midday Call data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = 'Midday';
        $files = Storage::disk('local2')->files($directory);
        DB::table('call_midday_imports')->delete();
        $filteredFiles = [];
        $desiredDate = Carbon::today()->format('Y-m-d');

        foreach ($files as $file) 
        {
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

        $user = User::where('name', 'SuperUser')->first();
        $user->notify(new NotificationsMiddayCallImport());
    }
}

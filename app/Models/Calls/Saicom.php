<?php

namespace App\Models\Calls;

use App\Jobs\ProcessCsvUpload;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Saicom extends Model
{
    use HasFactory;  

    protected $fillable = [
        'startTime',
        'groupName',
        'userID',
        'fromNumber',
        'dialedNumber',
        'answered',
        'answerTime',
        'releaseTime',
        'terminationCause',
        'trackingID',
        'callID',
        'groupNumber',
    ];

    public function importToDB()
    {
        $path = resource_path('pending-files/*.csv');

        $files = glob($path);

        foreach ($files as $key=>$file)
        {
            set_time_limit(0);
            ini_set('memory_limit', '2048M');
            ProcessCsvUpload::dispatch($file);
        }
    }

}

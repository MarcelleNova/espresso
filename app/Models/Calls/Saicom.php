<?php

namespace App\Models\Calls;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'releaseTime',
        'terminationCause',
        'trackingID',
        'callID',
        'groupNumber',
    ];
}

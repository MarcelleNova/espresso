<?php

namespace App\Models\calls;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallData extends Model
{
    use HasFactory;

    protected $fillable = 
    [
            'callMonth',
            'salaryMonth',
            'venueID',
            'ventureID',
            'date',
            'time',
            'ringTime',
            'duration',
            'durationCalc',
            'dialType',
            'fromNumber',
            'extension',
            'dialedNumber',
            'answered',
            'cost',
            'numberExtract',
            'extExtension',
            'callHour',
            'TSR',
            'uniqueUsers',
            'matchedWon',
            'matchedModBitrix',
            'matchedModScreenshot',
            'matchedViewed',
            'matchedLast20Days',
            'matchedAny',
            'matchedWith',
            'FINAL',
            'finalVentureID',
            'finalVenueID',
            'finalPipeline',
            'finalDealCategory',
            'finalRefNumber',
            'finalSalesOption',
            'matchedRTO',
            'bitrixTSR',
            'bitrixID',
            'count'
    ];

    public function venue()
    {
        return $this->hasOne('App\Models\admin\Venue', 'venue', 'name');
    }

    public function venture()
    {
        return $this->hasOne('App\Models\admin\Venture', 'venture','name');
    }
}

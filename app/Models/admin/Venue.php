<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $table = 'venues';

    protected $fillable = [
        'name',
        'description',
    ];

    public function calls()
    {
        return $this->hasMany('App\Models\Calls\CallData','venueID');
    }
}

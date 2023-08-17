<?php

namespace App\Models\admin;

use App\Models\Calls\PhonesMovement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venture extends Model
{
    use HasFactory;

    protected $table = 'ventures';

    protected $fillable = [
        'name',
        'description',
    ];

    public function calls()
    {
        return $this->hasMany('App\Models\Calls\CallData','ventureID');
    }

    public function phoneMovement()
    {
        return $this->hasMany(PhonesMovement::class,'venture');
    }
}

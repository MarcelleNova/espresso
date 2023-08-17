<?php

namespace App\Models\Calls;

use App\Models\User;
use App\Models\admin\Venue;
use App\Models\admin\Venture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhonesMovement extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function phone()
    {
        return $this->belongsTo(Phones::class, 'phoneID');
    }

    public function Venture()
    {
        return $this->hasOne(Venture::class, 'id', 'venture');
    }


    public function Venue()
    {
        return $this->hasOne(Venue::class, 'id', 'venue');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'movedByUserID');
    }
}

<?php

namespace App\Models\Calls;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{
    use HasFactory;

    protected $fillable = [
        'saicomUsername',
        'displayName',
        'extension'
    ];

    public function movements()
    {
        return $this->hasMany(PhonesMovement::class, 'phoneID');
    }
    
}

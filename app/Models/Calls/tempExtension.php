<?php

namespace App\Models\calls;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempExtension extends Model
{
    use HasFactory;

    
    protected $connection = 'mysql';
    protected $table = 'extentions';
}

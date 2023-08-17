<?php

namespace App\Models\sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp_lead_source extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'temp_lead_source';
}

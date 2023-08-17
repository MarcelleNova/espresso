<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitrixUsers extends Model
{
    use HasFactory;

    protected $connection = 'mysql_bitrix';
    protected $table = 'b_user';
}

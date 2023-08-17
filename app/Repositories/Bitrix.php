<?php

namespace App\Repositories;

use App\Models\admin\BitrixUsers;
use Auth;

class Bitrix 
{
    public static function allUsers()
    {
        return BitrixUsers::latest()->paginate(10);
    }

    public static function findUser($id)
    {
        return BitrixUsers::find($id);
    }
}


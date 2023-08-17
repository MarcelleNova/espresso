<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Facade;

class BitrixFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bitrix';
    }
}

<?php

namespace Jakjr\Dropzone;

use Illuminate\Support\Facades\Facade;

class DropzoneFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'dropzone';
    }

}
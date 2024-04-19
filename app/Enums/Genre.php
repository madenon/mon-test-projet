<?php

namespace App\Enums;

use App\Models\UserInfos;



enum Genre: string
    {
        case Male = 'male';
        case Female = 'female';        
    }
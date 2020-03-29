<?php

namespace App\Object;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Settings;
use App\Models\Slides;
use App\Models\Danhmuc;
use App\Models\Pubg;
use App\Models\Freefire;
use App\Models\Lienquan;
use App\Models\Random;
use Hash;
use Session;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class GameRandom
{

    public function __construct()
    { }

    /**
     * Chuyển đổi type
     * @param int
     * @return string
     */
    function getType($type)
    {
        switch ($type) {
            case 0:
                $type = "Random Ngọc Rồng";
                break;
            case 1:
                $type = "Random PUBG";
                break;
            case 2:
                $type = "Random Liên Quân";
                break;
            case 3:
                $type = "Random Free Fire";
                break;
            case 4:
                $type = "Random Liên Minh";
                break;
            case 5:
                $type = "Random Mở Rương";
                break;
            default:
                $type = "Random";
                break;
        }
        return $type;
    }
}

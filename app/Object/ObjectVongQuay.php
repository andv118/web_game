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


class ObjectVongQuay
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
                $type = "Vòng quay vàng";
                break;
            case 1:
                $type = "Vòng quay nick";
                break;
            default:
                $type = "Vòng quay";
                break;
        }
        return $type;
    }

    /**
     * Chuyển đổi type
     * @param int
     * @return string
     */
    function getCost($cost)
    {
        switch ($cost) {
            case 20000:
                $cost = "20K";
                break;
            case 50000:
                $cost = "50k";
                break;
            default:
                $cost = "";
                break;
        }
        return $cost;
    }

    /**
     * Chuyển đổi type
     * @param int
     * @return string
     */
    function getCategory($type, $cost)
    {   
        $category = $this->getType($type) . " " . $this->getCost($cost);
        return $category;
    }
}

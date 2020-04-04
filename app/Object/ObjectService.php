<?php

namespace App\Object;

class ObjectService
{

    public function __construct()
    { }

    /**
     * Chuyển đổi trade type (kiểu dịch vụ)
     * @param int
     * @return string
     */
    function getTradeType($type)
    {
        switch ($type) {
            case 1:
                $type = "Mua Ngọc";
                break;
            case 2:
                $type = "Mua Vàng";
                break;
            case 3:
                $type = "Làm Nhhiệm Vụ";
                break;
            case 4:
                $type = "Săn Đệ Tử";
                break;
            case 5:
                $type = "Up Bí Kíp - Yadart";
                break;
            case 6:
                $type = "Up Sức Mạnh Đệ Tử";
                break;
            case 7:
                $type = "Up Sức Mạnh Sư Phụ";
                break;
            default:
                $type = "Dịch vụ";
                break;
        }
        return $type;
    }
}

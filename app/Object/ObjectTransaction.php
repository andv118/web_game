<?php

namespace App\Object;

class ObjectTransaction
{

    public function __construct()
    { }

    /**
     * Chuyển đổi trade type (kiểu giao dịch)
     * @param int
     * @return string
     */
    function getTradeType($type)
    {
        switch ($type) {
            case 1:
                $type = "Hoàn tiền";
                break;
            case 2:
                $type = "Chuyển tiền";
                break;
            case 3:
                $type = "Nhận tiền";
                break;
            case 4:
                $type = "Nạp tiền";
                break;
            case 5:
                $type = "Mua tài khoản";
                break;
            case 6:
                $type = "Đặt cọc";
                break;
            case 7:
                $type = "Bán tài khoản";
                break;
            case 8:
                $type = "Mua dịch vụ";
                break;
            case 9:
                $type = "Mua lượt quay";
                break;
            default:
                $type = "Giao dịch";
                break;
        }
        return $type;
    }
}

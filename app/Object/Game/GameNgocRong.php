<?php

namespace App\Object\Game;

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


class GameNgocRong
{

    private $game = 'nr';
    private $url = 'public/client/assets/upload/';

    public function __construct()
    { }

    /**
     * Chuyển đổi đệ tử
     * @param int
     * @return string
     */
    function strDeTu($value)
    {
        switch ($value) {
            case 1:
                $str = "Có";
                break;
            case 2:
                $str = "Không";
                break;
            default:
                $str = "---";
                break;
        }
        return $str;
    }

    /**
     * Chuyển đổi bông tai
     * @param int
     * @return string
     */
    function strBongTai($value)
    {
        switch ($value) {
            case 1:
                $str = "Có";
                break;
            case 2:
                $str = "Không";
                break;
            default:
                $str = "---";
                break;
        }
        return $str;
    }

    /**
     * Chuyển đổi hành tinh
     * @param int
     * @return string
     */
    function strHanhTinh($value)
    {
        switch ($value) {
            case 1:
                $str = "Xayda";
                break;
            case 2:
                $str = "Namec";
                break;
            case 3:
                $str = "Trái Đất";
                break;
            default:
                $str = "---";
                break;
        }
        return $str;
    }

    /**
     * Chuyển đổi đăng ký
     * @param int
     * @return string
     */
    function strDangKy($value)
    {
        switch ($value) {
            case 1:
                $str = "Ảo";
                break;
            case 2:
                $str = "Gmail Full";
                break;
            default:
                $str = "---";
                break;
        }
        return $str;
    }

    /**
     * Chuyển đổi vũ trụ (server)
     * @param int
     * @return string
     */
    function strServer($value)
    {
        switch ($value) {
            case 1:
                $str = "Vũ Trụ 1 sao";
                break;
            case 2:
                $str = "Vũ Trụ 2 sao";
                break;
            case 3:
                $str = "Vũ Trụ 3 sao";
                break;
            case 4:
                $str = "Vũ Trụ 4 sao";
                break;
            case 5:
                $str = "Vũ Trụ 5 sao";
                break;
            case 6:
                $str = "Vũ Trụ 6 sao";
                break;
            case 7:
                $str = "Vũ Trụ 7 sao";
                break;
            case 8:
                $str = "Vũ Trụ 8 sao";
                break;
            case 9:
                $str = "SV nước ngoài";
                break;

            default:
                $str = "---";
                break;
        }
        return $str;
    }

    /**
     * Xử lý chuỗi note quá dài
     * @param string
     * @return string
     */
    function strNote($note)
    {
        $note = htmlspecialchars(strip_tags(substr($note, 0, 25)), ENT_QUOTES, 'UTF-8');
        if (strlen($note) > 25) {
            return '...';
        }
        return $note;
    }

    /**
     * Lấy ảnh đại diện
     * @param int
     * @return string url
     */
    function getThumbnail($id)
    {
        $thumb = $this->url . 'thumb-' . $id . '-' . $this->game . '.*';
        $img = glob($thumb);
        if (sizeof($img) != 0) {
            $arr = explode("/", $img[0]);
            $last = array_pop($arr);
            return url('/') . "/" . $this->url . $last;
        }
        return url('/') . "/" . $this->url . "no-thumbnail.jpg";
    }

    /**
     * Lấy ảnh chi tiết
     * @param int
     * @return string url
     */
    function getImage($id)
    {
        $arrImage = [];
        $image = $this->url . 'image-' . $id . '-' . $this->game . '*';
        $image = glob($image);
        if (sizeof($image) > 0) {
            foreach ($image as $img) {
                $arr = explode("/", $img);
                $last = array_pop($arr);
                $arrImage[] = url('/') . "/" . $this->url . $last;
            }
            return $arrImage;
        }
        return null;
    }


    /**
     * Xóa ảnh (khi mua và khi xóa acc)
     * @param int
     * 
     */
    function deleteImage($id)
    {
        // delete thumb
        $thumbs = $this->url . 'thumb-' . $id . '-' . $this->game . '*';
        $thumbs = glob($thumbs);
        if (sizeof($thumbs) > 0) {
            foreach ($thumbs as $thumb) {
                unlink($thumb);
            }
        }
        // delete image
        $images = $this->url . 'image-' . $id . '-' . $this->game . '*';
        $images = glob($images);
        if (sizeof($images) > 0) {
            foreach ($images as $img) {
                unlink($img);
            }
        }
    }

    /**
     * Upload ảnh (khi thêm acc)
     * @param int
     * 
     */
    function uploadImage($id, $thumb, $imgaes)
    {
        $folder = 'assets/upload/';
        // upload thumb
        $thumbDuoiFile = $thumb->getClientOriginalExtension();
        $name = $folder . 'thumb-' . $id . '-' . $this->game . '.' . $thumbDuoiFile;
        Storage::put($name,  File::get($thumb));

        // upload images
        foreach ($imgaes as $k => $img) {
            $stt = $k + 1;
            $imgDuoiFile = $img->getClientOriginalExtension();
            $name = $folder . 'image-' . $id . '-' . $this->game . '_' . $stt . '.' . $imgDuoiFile;
            Storage::put($name,  File::get($img));
        }
    }
}

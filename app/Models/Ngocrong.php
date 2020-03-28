<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ngocrong extends Model
{
    protected $table = "ngoc_rong";

    public $timestamps = false;


    public function scopeId($query, $id)
    {
        if ($id != null) {
            $query->where('ngoc_rong.id', '=', $id);
        }
        return $query;
    }

    public function scopePrice($query, $price1, $price2)
    {
        if ($price1 != null) {
            if ($price2 == null) {
                $query->where('cost', '>', $price1);
            } else {
                $query->whereBetween('cost', [$price1, $price2]);
            }
        }
        return $query;
    }

    public function scopeStatus($query, $status)
    {
        if ($status != null) {
            $query->where('status', '=', $status);
        }
        return $query;
    }

    public function scopeBongtai($query, $bongtai)
    {
        if ($bongtai != null) {
            $query->where('bongtai', '=', $bongtai);
        }
        return $query;
    }

    public function scopeDetu($query, $detu)
    {
        if ($detu != null) {
            $query->where('detu', '=', $detu);
        }
        return $query;
    }

    public function scopeHanhtinh($query, $hanhtinh)
    {
        if ($hanhtinh != null) {
            $query->where('hanhtinh', '=', $hanhtinh);
        }
        return $query;
    }

    public function scopeDangky($query, $dangky)
    {
        if ($dangky != null) {
            $query->where('dk', '=', $dangky);
        }
        return $query;
    }

    public function scopeServer($query, $server)
    {
        if ($server != null) {
            $query->where('server', '=', $server);
        }
        return $query;
    }

    public function scopeNote($query, $keyword)
    {
        if ($keyword != null) {
            $query->where('note', 'like', '%' . $keyword . '%');
        }
        return $query;
    }

    public function scopeCTV($query, $ctv_name)
    {
        if ($ctv_name != null) {
            $query->where('name', 'like', '%' . $ctv_name . '%');
        }
        return $query;
    }

    public function scopeInfor($query, $infor)
    {
        if ($infor != null) {
            $query->where('info', 'like', '%' . $infor . '%');
        }
        return $query;
    }

}

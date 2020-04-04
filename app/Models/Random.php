<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Random extends Model
{
    protected $table = "random";

    public $timestamps = false;

    public function scopeId($query, $id)
    {
        if ($id != null) {
            $query->where('random.id', '=', $id);
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

    public function scopeType($query, $type)
    {
        if ($type != null) {
            $query->where('type', '=' , $type);
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

    public function scopeYear($query, $year)
    {
        if ($year != null) {
            $query->whereYear('date', $year);
        }
        return $query;
    }

    public function scopeMonth($query, $month)
    {
        if ($month != null) {
            $query->whereMonth('date', $month);
        }
        return $query;
    }

    public function scopeDay($query, $day)
    {
        if ($day != null) {
            $query->whereDay('date', $day);
        }
        return $query;
    }


}



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
            $query->where('type', 'like', '%' . $type . '%');
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



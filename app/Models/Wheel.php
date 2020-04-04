<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wheel extends Model
{
    protected $table = "wheel_log";

    public $timestamps = false;

    /**
     * Scope chọn user
     * @param query, array
     * @return query
     */
    public function scopeId($query, $id)
    {
        if ($id != null) {
            $query->where('wheel_log.id', '=', $id);
        }
        return $query;
    }

     /**
     * Scope chọn thời gian
     * @param query, array
     * @return query
     */
    public function scopeTime($query, $started_at, $ended_at)
    {
        if ($started_at != null && $ended_at != null) {
            $query->whereBetween('date',  [$started_at, $ended_at]);
        } elseif ($started_at != null) {
            $query->where('date', '>=', $started_at);
        } elseif ($ended_at != null) {
            $query->where('date', '<=', $ended_at);
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


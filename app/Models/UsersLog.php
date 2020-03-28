<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersLog extends Model
{
    protected $table = "users_log";

    public $timestamps = false;

    /**
     * Scope kiểu giao dịch
     * @param query, int
     * @return query
     */
    public function scopeTrade($query, $trade)
    {
        if ($trade != null) {
            $query->where('trade_type', '=', $trade);
        }
        return $query;
    }

    /**
     * Scope chọn thời gian
     * @param query string string
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

    /**
     * Scope chọn user
     * @param query, array
     * @return query
     */
    public function scopeUser($query, $user_id)
    {
        if ($user_id != null) {
            $query->where('user_id', '=', $user_id);
        }
        return $query;
    }

    /**
     * Scope chọn serial
     * @param query, string
     * @return query
     */
    public function scopeSerial($query, $serial)
    {
        if ($serial != null) {
            $query->where('serial', '=', $serial);
        }
        return $query;
    }

    /**
     * Scope where user name (join table users)
     * @param query, string
     * @return query
     */
    public function scopeUserName($query, $user_name)
    {
        if ($user_name != null) {
            $query->where('name', 'like', '%' . $user_name . '%');
        }
        return $query;
    }

    /**
     * Scope chọn user
     * @param query, array
     * @return query
     */
    public function scopeUpdateCallback($query, $user_id, $status)
    {
        if ($user_id != null && $status != null) {
            $query->where('user_id', '=', $user_id)
                ->upadte(['status' => $status]);
        }
        return $query;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersService extends Model
{
    protected $table = "users_service";

    public $timestamps = false;

    /**
     * Scope chọn user
     * @param query, string
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
     * Scope id
     * @param query, int
     * @return query
     */
    public function scopeId($query, $id)
    {
        if ($id != null) {
            $query->where('id', '=', $id);
        }
        return $query;
    }

    /**
     * Scope chọn thời gian
     * @param query, string
     * @return query
     */
    public function scopeTime($query, $started_at, $ended_at)
    {
        if ($started_at != null && $ended_at != null) {
            $query->whereBetween('date',  [$started_at, $ended_at]);
        } elseif($started_at != null) {
            $query->where('date', '>=', $started_at);
        } elseif($ended_at != null) {
            $query->where('date', '<=', $ended_at);
        }
        return $query;
    }

    /**
     * Scope trade type
     * @param query, string
     * @return query
     */
    public function scopeTradeType($query, $trade_type)
    {
        if ($trade_type != null) {
            $query->where('trade_type', '=', $trade_type);
        }
        return $query;
    }

     /**
     * Scope trade type
     * @param query, int
     * @return query
     */
    public function scopeStatus($query, $status)
    {
        if ($status != null) {
            $query->where('status', '=', $status);
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
            $query->where('name', 'like', '%'. $user_name .'%');
        }
        return $query;
    }
}

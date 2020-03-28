<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersGift extends Model
{
    protected $table = "users_gift";

    public $timestamps = false;

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
     * Scope kiểu nhà mạng
     * @param query, array
     * @return query
     */
    public function scopeId($query, $id)
    {
        if ($id != null) {
            $query->where('tel', '=', $id);
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
        } elseif($started_at != null) {
            $query->where('date', '>=', $started_at);
        } elseif($ended_at != null) {
            $query->where('date', '<=', $ended_at);
        }
        return $query;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NapCham extends Model
{
    protected $table = "nap_cham";

    public $timestamps = false;

    protected $fillable = ['id', 'user_id', 'serial', 'pin', 'tel', 'desc', 'amount', 'fee', 'status', 'type', 'date', 'add_time', 'trans_id', 'domain'];

    /**
     * Scope chọn user
     * @param query, array
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
    public function scopeType($query, $telco)
    {
        if ($telco != null) {
            $query->where('tel', '=', $telco);
        }
        return $query;
    }

    /**
     * Scope serial hoặc pin
     * @param query, array
     * @return query
     */
    public function scopeCard($query, $numberCard)
    {
        if ($numberCard != null) {
            $query->where('serial', '=', $numberCard)
                ->orWhere('pin', '=', $numberCard);
        }
        return $query;
    }

    /**
     * Scope serial
     * @param query, array
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

    /**
     * Scope chọn thời gian
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
     * Scope check thẻ
     * @param query, array
     * @return query
     */
    public function scopeCheckCard($query, $code, $serial)
    {
        if ($code != null && $serial != null) {
            $query->where('pin', '=', $code)
                ->orWhere('serial', '=', $serial);
        }
        return $query;
    }

    /**
     * Scope where user name (join table users)
     * @param query, array
     * @return query
     */
    public function scopeUserName($query, $user_name)
    {
        if ($user_name != null) {
            $query->where('name', 'like', '%' . $user_name . '%');
        }
        return $query;
    }
  
}

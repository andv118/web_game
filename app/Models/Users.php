<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Users extends Model
{
    protected $table = "users";

    public $timestamps = false;
    
    
    protected $filltable = ['name','password','user_agent','user_phone','email','last_time','domain','user_id'];

    /**
     * get User
     * @return boolean;
     */
    public function getUser($userId)
    {
        $user = Users::select('id', 'user_id', 'name', 'password', 'user_phone', 'email', 'cash', 'point', 'locked', 'is_admin')
            ->where([
                ['user_id', '=', $userId],
            ])->get();
        return $user;
    }

    /**
     * get user_id
     * @param string string
     * @return string
     */
    public function scopeId($query, $id)
    {
        if ($id != null) {
            $query->where('id', '=', $id);
        }
        return $query;
    }

    /**
     * get user_id
     * @param string string
     * @return string
     */
    public function scopeUserId($query, $user_id)
    {
        if ($user_id != null) {
            $query->where('user_id', '=', $user_id);
        }
        return $query;
    }

     /**
     * get user_id
     * @param string string
     * @return string
     */
    public function scopeUserAdmin($query, $is_admin)
    {
        if ($is_admin != null) {
            $query->where('is_admin', '=', $is_admin);
        }
        return $query;
    }


    public function scopeKeyword($query, $keyword)
    {
        if ($keyword != null) {
            $query->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->orWhere('user_phone', 'like', '%' . $keyword . '%');
        }
        return $query;
    }

}
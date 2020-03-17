<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;


/**
 * @property string id 用户id
 * @property string avatar 用户头像
 * @property string sex 性别 1男 0女
 * @property string last_login 用户登陆时间
 * @property string email 邮箱
 * @property string password 密码
 * @property string jifen 积分
 * @property string name 用户名
 */
class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles(){
        return $this->hasMany(Article::class,'user_id','id');
    }

    public function books(){
        return $this->hasMany(Book::class,'user_id','id');
    }
}

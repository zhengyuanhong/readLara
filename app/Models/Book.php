<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *@property string id 书籍ID
 *@property string user_id 创建者
 *@property string name 书籍名称
 *@property string url_name 链接名称
 *@property string url 链接
 *@property string img_url 图片链接
 */
class Book extends Model
{
    protected $table = 'books';
}

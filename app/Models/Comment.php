<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 *@property string id 书籍ID
 *@property string user_id 发布者
 *@property string article_id 所属文章
 *@property string content 评论内容
 */
class Comment extends Model
{
    protected $table = 'comments';
}

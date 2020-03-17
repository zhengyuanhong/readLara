<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *@property string id 书籍ID
 *@property string user_id 发布者
 *@property string book_id 所属书籍
 *@property string title 标题
 *@property string content 内容
 *@property string is_show 是否显示
 *@property string is_top 是否置顶
 */
class Article extends Model
{
    protected $table = 'articles';
}

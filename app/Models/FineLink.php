<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 *@property string id 书籍ID
 *@property string link_name 链接名
 *@property string link 链接地址
 */
class FineLink extends Model
{
    protected $table = 'fine_links';
}

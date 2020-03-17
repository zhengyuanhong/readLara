<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('avatar', __('头像'));
        $grid->column('name', __('用户名'));
        $grid->column('sex', __('性别'))->display(function ($sex) {
            return $sex == 0 ? '女' : '男';
        });
        $grid->column('jifen', __('积分'));
        $grid->column('email', __('邮箱'));
        $grid->column('last_login', __('登陆时间'))->display(function ($time) {
            if (empty($time)) {
                return '-';
            }
            $now = time();
            $last_time = strtotime($time);
            $diff = intval(($now - $last_time) / 86400);
            if ($diff == 0) {
                return '今天';
            } elseif ($diff > 0 && $diff < 7) {
                return $diff . '天前';
            }

            $diff = intval(($now - $last_time) / 604800);
            if($diff == 0){
                return '一周前';
            }elseif($diff > 0 && $diff < 5){
                return $diff . '周前';
            }

            return $time;

        });
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('avatar', __('头像'));
        $show->field('name', __('用户名'));
        $show->field('sex', __('性别'));
        $show->field('jifen', __('积分'));
        $show->field('email', __('邮箱'));
        $show->field('remember_token', __('验证'));
        $show->field('last_login', __('登陆时间'));
        $show->field('email_verified_at', __('验证时间'));
        $show->field('updated_at', __('更新时间'));
        $show->field('created_at', __('创建时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->image('avatar', __('头像'));
        $form->text('name', __('用户名'));
        $form->switch('sex', __('性别'))->default(1);
        $form->number('jifen', __('积分'));
        $form->email('email', __('邮箱'));
        $form->text('remember_token', __('验证'));
        $form->datetime('last_login', __('上次登陆时间'))->default(date('Y-m-d H:i:s'));
        $form->datetime('email_verified_at', __('验证时间'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}

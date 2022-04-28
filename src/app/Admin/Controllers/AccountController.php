<?php

namespace App\Admin\Controllers;

use App\Models\Account;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AccountController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Account';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Account());

        $grid->column('id', __('Id'));
        $grid->column('type', __('Type'));
        $grid->column('twitter_id', __('Twitter id'));
        $grid->column('screen_name', __('Screen name'));
        $grid->column('access_token', __('Access token'));
        $grid->column('access_secret', __('Access secret'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Account::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type', __('Type'));
        $show->field('twitter_id', __('Twitter id'));
        $show->field('screen_name', __('Screen name'));
        $show->field('access_token', __('Access token'));
        $show->field('access_secret', __('Access secret'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Account());

        $form->text('type', __('Type'));
        $form->text('twitter_id', __('Twitter id'));
        $form->text('screen_name', __('Screen name'));
        $form->text('access_token', __('Access token'));
        $form->text('access_secret', __('Access secret'));

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;

use App\Models\Log;
use Encore\Admin\Actions\Action;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Show;

class LogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'エラーログ';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Log());

        $grid->column('bot.screen_name', 'BOTのアカウント名');
        $grid->column('target.screen_name', '対象アカウントのアカウント名');
        $grid->column('code', 'エラーコード');
        $grid->column('message', 'エラーメッセージ');

        $grid->actions(function (Actions $actions) {
            $actions->disableAll();
        });

        $grid->filter(function(Filter $filter){
            $filter->disableIdFilter();
        });

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
        $show = new Show(Log::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('bot_id', __('Bot id'));
        $show->field('target_id', __('Target id'));
        $show->field('code', __('Code'));
        $show->field('message', __('Message'));
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
        $form = new Form(new Log());

        $form->number('bot_id', __('Bot id'));
        $form->number('target_id', __('Target id'));
        $form->number('code', __('Code'));
        $form->text('message', __('Message'));

        return $form;
    }
}

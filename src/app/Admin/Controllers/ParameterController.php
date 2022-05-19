<?php

namespace App\Admin\Controllers;

use App\Models\Parameter;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ParameterController extends AdminController
{

    public function index(Content $content)
    {
        $content = parent::index($content);
        return $content
            ->withInfo('コールバックURL', url('/auth/callback'));
    }

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '設定値';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Parameter());


        $grid->column('summary', '説明');
        $grid->column('key', 'キー');
        $grid->column('value', '値');

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableView();
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
        $show = new Show(Parameter::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('summary', __('Summary'));
        $show->field('key', __('Key'));
        $show->field('value', __('Value'));
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
        $form = new Form(new Parameter());

        $form->text('summary', '説明')->readonly();
        $form->text('value', '値');

        return $form;
    }
}

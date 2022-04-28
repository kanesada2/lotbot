<?php

namespace App\Admin\Controllers;

use App\Models\Parameter;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ParameterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Parameter';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Parameter());

        $grid->column('id', __('Id'));
        $grid->column('summary', __('Summary'));
        $grid->column('key', __('Key'));
        $grid->column('value', __('Value'));
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

        $form->text('summary', __('Summary'));
        $form->text('key', __('Key'));
        $form->text('value', __('Value'));

        return $form;
    }
}

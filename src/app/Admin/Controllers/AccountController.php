<?php

namespace App\Admin\Controllers;

use App\Models\Account;
use App\Services\TwitterAPI;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

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

        $grid->column('screen_name', 'アカウント名（@）');
        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableView();
        });

        $grid->filter(function(Filter $filter){
            $filter->disableIdFilter();
            $filter->equal('type', 'アカウント種別')->select(['bot' => 'BOTアカウント', 'target' => '抽選対象アカウント']);
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
        $show = new Show(Account::findOrFail($id));

        $show->field('type', 'アカウント種別');
        $show->field('screen_name', 'アカウント名（@）');
        $show->field('twitter_id', 'twitterのid');

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

        $form->hidden('type', 'アカウント種別');
        $form->text('screen_name', 'アカウント名（@）')->required();
        $form->hidden('twitter_id', 'twitterのid');

        $form->saving(function(Form $form){
            if(!$form->input('type')){
                $form->input('type', Account::ACCOUNT_TYPE_TARGET);
            }
            if(!$form->input('twitter_id')){
                /** @var Account $first */
                $first = Account::listBots()->first();
                $twitter = new TwitterAPI();
                $twitter->authenticate($first);
                $id = $twitter->screenName2Id($form->input('screen_name'));
                if(!$id){
                    $error = new MessageBag([
                        'title'   => 'エラー',
                        'message' => 'そのユーザー名のアカウントは存在しません',
                    ]);
                
                    return back()->with(compact('error'));
                }
                $form->input('twitter_id', $id);
            }
        });
        return $form;
    }
}

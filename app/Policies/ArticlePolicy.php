<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user, Article $article)
    {
        if ($user->can('manage_contents')) {
            return true;
        }
    }

    public function view(User $user, Article $article)
    {
        //已经购买阅读权限的
        $has_buy = Order::query()->where('user_id','=',$user->id)
            ->where('note_id','=',$article->chapter->note->id)
            ->where('status','=',1)
            ->first();
        //只有阅读权限的人或者笔记免费的才可以观看
        if ($user->can('read_article') || $article->chapter->note->need_pay==0 || !empty($has_buy)) {
            return true;
        }
    }
}

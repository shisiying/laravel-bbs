<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function view(User $user, Note $note)
    {
        //已经购买阅读权限的
        $has_buy = Order::query()->where('user_id','=',$user->id)
                ->where('note_id','=',$note->id)
                ->where('status','=',1)
                ->first();

        //只有阅读权限的人或者笔记免费的才可以观看
        if ($user->can('read_article') || $note->need_pay==0 || !empty($has_buy)) {
            return true;
        }
    }
}

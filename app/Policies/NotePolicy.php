<?php

namespace App\Policies;

use App\Models\Note;
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
        //只有阅读权限的人或者笔记免费的才可以观看
        if ($user->can('read_article') || $note->need_pay==0) {
            return true;
        }
    }
}

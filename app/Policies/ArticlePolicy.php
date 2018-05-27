<?php

namespace App\Policies;

use App\Models\Article;
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
}

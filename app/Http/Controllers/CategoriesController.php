<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Models\User;

class CategoriesController extends Controller
{
    public function show(Category $category,Request $request,Topic $topic,User $user)
    {
         // 读取分类 ID 关联的话题，并按每 20 条分页
        $topics = Topic::withOrder($request->order)->where('category_id', $category->id)->paginate(20);
        $active_users = $user->getActiveUsers();
        return view('topics.index',compact('topics','category','active_users'));
    }
}

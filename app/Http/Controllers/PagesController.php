<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use Auth;
use App\Models\User;
use App\Models\Link;
use App\Models\Category;
use App\Models\Note;
use App\Models\Article;
use phpDocumentor\Reflection\Types\Null_;

class PagesController extends Controller
{
    public function root(Link $link)
    {
        $banners = $link->allByPosition();
        return view('pages.root', compact('topics', 'banners'));
    }

    public function permissionDenied()
    {
        if (config('administrator.permission')()) {
            return redirect(url(config('administrator.uri')), 302);
        }

        return view('pages.permission_denied');
    }

    public function community(Request $request,Topic $topic,User $user,Link $link)
    {
        $topics = Topic::withOrder($request->order)->paginate(30);
        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
        $categories = Category::all();
        $banners = $link->allByPosition();
        return view('topics.index', compact('topics','active_users','links','categories','banners'));
    }

    public function docs()
    {

        if (Auth::id()!=Null && Auth::user()->hasPermissionTo('manage_contents')){
            $notes = Note::all();
        }else{
            $notes = Note::query()->where('is_recommended', 1)->get();
        }
        return view('docs.root',compact('notes'));
    }
    public function life()
    {
        $lifes = Article::query()->where(['type'=>1,'chapter_id'=>1])->get();
        return view('life.index',compact('lifes'));
    }

    public function works()
    {
        $works = Article::query()->where(['type'=>2,'author'=>1])->get();
        $worksBySeven = Article::query()->where(['type'=>2,'author'=>0])->get();
        return view('pages.works',compact('works','worksBySeven'));

    }

    public function about()
    {
        $article = Article::query()->where(['type'=>0,'chapter_id'=>3])->first();
        return view('about.index',compact('article'));
    }
}

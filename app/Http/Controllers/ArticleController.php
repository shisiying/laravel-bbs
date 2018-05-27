<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Chapter;
use App\Http\Requests\ArticleRequest;
use function PHPSTORM_META\type;
use XHZ\Markdown\Markdown;
use App\Models\Link;
use Auth;




class ArticleController extends Controller
{
    public function create(Article $article)
    {
        $this->authorize('update',$article);
       $chapters = Chapter::query()->where('id','>',2)->get();
       return view('docs.create_and_edit',compact('article','chapters'));

    }

    public function store(ArticleRequest $request,Article $article)
    {
        $this->authorize('update',$article);
        $markdown = new Markdown;
        if ($request->type==2 || $request->type==1)
        {
            $request->chapter_id =$request->type;
            $body = $markdown->convertMarkdownToHtml($request->body);

            if ($request->type==2){
                $body = strip_tags($body,'<i>,<br>');
            }
            Article::create([
                'body' => $body,
                'title'=>$request->title,
                'chapter_id'=>$request->chapter_id,
                'link'=>$request->link,
                'type'=>$request->type,
                'user_id'=>Auth::id(),
                'author'=>$request->author,
            ]);
            return redirect()->route('works')->with('message', '成功创建作品或者发布生活状态！');
        }else if ($request->type==='0'){
            $articleObj = Article::create([
                'body' =>$markdown->convertMarkdownToHtml($request->body),
                'title'=>$request->title,
                'chapter_id'=>$request->chapter_id,
                'link'=>$request->link,
                'type'=>$request->type,
                'user_id'=>Auth::id(),
                'author'=>$request->author,
            ]);
            return redirect()->route('article.show',$articleObj->id)->with('message', '成功创建文章！');
        }else{
            abort('403','发布类型不对');
        }
    }

    public function show(Article $article,Link $link)
    {
        $banners = $link->allByPosition();
        $links = $link->getAllCached();

        return view('docs.show',compact('article','banners','links'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        $markdown = new Markdown;
        $chapters = Chapter::all();
        //作品集类型
        if ($article->type!=2){
            $article->body = $markdown->convertHtmlToMarkdown($article->body);
        }

        return view('docs.create_and_edit', compact('article','chapters'));
    }

    public function update(ArticleRequest $request,Article $article)
    {

        $this->authorize('update',$article);
        $markdown = new Markdown;
        $request->chapter_id =$request->type;
        $body = $markdown->convertMarkdownToHtml($request->body);
        if ($request->type==2){
            $body = strip_tags($body,'<i>,<br>');
        }
        $article->update([
            'body' =>$body,
            'title'=>$request->title,
            'chapter_id'=>$request->chapter_id,
            'link'=>$request->link,
            'type'=>$request->type,
            'user_id'=>Auth::id(),
            'author'=>$request->author,
        ]);
        return redirect()->route('article.show',$article->id)->with('message', '成功更新文章！');
    }

    public function destroy(Article $article)
    {

        $this->authorize('update', $article);
        $article->delete();
        return redirect()->route('root')->with('message', '删除成功！');
    }

}

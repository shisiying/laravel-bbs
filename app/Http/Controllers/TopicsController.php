<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Auth;
use App\Models\User;
use App\Models\Link;
use App\Handlers\ImageUploadHandler;
use XHZ\Markdown\Markdown;


class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request,Topic $topic,User $user,Link $link)
	{
		$topics = Topic::withOrder($request->order)->paginate(30);
        $active_users = $user->getActiveUsers();
        $banners = $link->allByPosition();
        $links = $link->getAllCached();
		return view('topics.index', compact('topics','active_users','links','banners'));
	}

    public function show(Request $request,Topic $topic)
    {
         // URL 矫正
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }

        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function store(TopicRequest $request, Topic $topic)
	{
        $markdown = new Markdown;

        $topic->body = $markdown->convertMarkdownToHtml($request->body);
        $topic->title =$request->title;
        $topic->category_id = $request->category_id;
        $topic->user_id = Auth::id();
        $topic->save();
		return redirect()->to($topic->link())->with('message', '成功创建话题！');
	}

	public function edit(Topic $topic)
	{
        $markdown = new Markdown;

        $this->authorize('update', $topic);
        $categories = Category::all();
        $topic->body = $markdown->convertHtmlToMarkdown($topic->body);
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
        $markdown = new Markdown;

        $request->body = $markdown->convertMarkdownToHtml($request->body);
		$topic->update([
		    'title'=>$request->title,
            'body'=>$request->body,
            'category_id'=>$request->category_id,
        ]);

		return redirect()->route('topics.show', $topic->id)->with('message', '更新成功！');
	}

	public function destroy(Topic $topic)
	{

		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics')->with('message', '删除成功！');
	}

    public function uploadImage(Request $request,ImageUploadHandler $uploader)
    {
        //初始化返回数据，默认是失败的
        $data = [
            'success' =>false,
            'msg'=>'上传失败！',
            'file_path'=>''
        ];

        if($file = $request->upload_file){
            //保存图片到本地
            $result = $uploader->save($request->upload_file,'topics',\Auth::id(),1024);
            //图片保存成功
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg'] = '上传成功！';
                $data['success'] = true;
            }

        }

        return $data;
    }
}
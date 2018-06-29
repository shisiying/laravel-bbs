@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-8 main-col">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <p>
                        <i class="glyphicon glyphicon-edit"></i> Article /
                        @if($article->id)
                            编辑文章
                        @else
                            新建文章
                        @endif
                    </p>
                </div>

                @include('common.error')
                <div class="alert alert-warning">
                    我们希望XHZ-XED社区能够成为拥有浓厚文化与geek氛围的高素质社区，而实现这个目标，需要我们所有人的共同努力：友善，公平，尊重知识和事实。请严格遵守 - 社区文章发布规范
                </div>
                <div class="panel-body">
                    @if($article->id)
                        <form action="{{route('article.update',$article->id)}}" method="POST" accept-charset="UTF-8">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="chapter_id" id="chapter_id" value="{{$article->chapter_id}}">
                            @else
                                <form action="{{route('article.store')}}" method="POST" accept-charset="UTF-8">
                                    @endif

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group" id="notice">
                                        <p class="alert alert-success">要添加笔记，请点击<a href="/admin/notes">添加新笔记</a></p>
                                        <p class="alert alert-info">要添加章节，请点击<a href="/admin/chapters">添加新章节</a></p>
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" name="type" id="typeSelect" required>
                                            <option value="0">请选择文章发布的板块(默认为笔记板块，需要选择章节)</option>
                                            <option value="1" {{ $article->type == 1 ? 'selected' : '' }}>生活</option>
                                            <option value="2" {{ $article->type == 2 ? 'selected' : '' }}>作品集</option>
                                        </select>
                                    </div>

                                    <div class="form-group" hidden="hidden" id="authorSelect">
                                        <select class="form-control" name="author" required >
                                            <option value="0" {{ $article->author == 0 ? 'selected' : '' }}>小猴子</option>
                                            <option value="1" {{ $article->author == 1 ? 'selected' : '' }}>小耳朵</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="link" hidden="hidden">
                                        <input class="form-control" type="text" name="link" placeholder="链接" required value="{{ old('link', $article->link ) }}">
                                    </div>
                                    <div class="form-group" id="title" >
                                        <input class="form-control"  id="article-title" type="text" name="title" id="title-field" value="{{ old('title', $article->title ) }}" placeholder="请填写文章标题" required />
                                    </div>

                                    @if($article->id)
                                    <div class="form-group" >
                                        <select class="form-control" id="note" required>
                                            <option value="" hidden disabled {{$article->id?'':'selected'}}>请选择笔记</option>
                                            @foreach($notes as $note)
                                                <option value="{{ $note->id }}" {{$article->chapter->note->id == $note->id ? 'selected' : ''}}>{{$note->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        @else

                                        <div class="form-group">
                                            <select class="form-control" id="note"  required>
                                                <option value="" hidden disabled {{$article->id?'':'selected'}}>请选择笔记</option>
                                                @foreach($notes as $note)
                                                    <option value="{{ $note->id }}">{{$note->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    @endif
                                    <div class="form-group" id="chapter">
                                        <select class="form-control" name="chapter_id" id="chapter_select" required>
                                            <option value="" hidden disabled {{$article->id?'':'selected'}}>请选择章节</option>
                                            {{--@foreach($chapters as $value)--}}
                                                {{--<option value="{{ $value->id }}" {{ $article->chapter_id == $value->id ? 'selected' : '' }}>{{$value->note->name}}--{{ $value->name }}</option>--}}
                                            {{--@endforeach--}}
                                        </select>
                                    </div>

                                    <div id="reply_notice" class="box">
                                        <ul class="helpblock list">
                                            <li>请注意单词拼写，以及中英文排版，参考<a href="https://github.com/sparanoid/chinese-copywriting-guidelines">此页</a></li>
                                            <li>支持 Markdown 格式, **粗体**、~~删除线~~、`单行代码`, 更多语法请见这里 <a href="https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md">Markdown 语法</a></li>
                                            <li>支持表情，使用方法请见 <a href="https://laravel-china.org/topics/45" target="_blank">Emoji 自动补全来咯</a>，可用的 Emoji 请见 :metal: :point_right: <a href="https://laravel-china.org/ecc/index.html" target="_blank" rel="nofollow"> Emoji 列表 </a> :star: :sparkles: </li>
                                            <li>上传图片, 支持拖拽和剪切板黏贴上传, 格式限制 - jpg, png, gif</li>
                                            <li>发布框支持本地存储功能，会在内容变更时保存，「提交」按钮点击时清空</li>
                                            <li>项目star数模板，如下:<xmp>python/scrapy<br /><i class="fa fa-star">5</i></xmp></li>
                                        </ul>
                                    </div>

                                    <div class="form-group">
                                        <textarea name="body"  id='body' class="form-control" placeholder="使用markdowng格式输入你的内容" rows="3">{{ old('body', $article->body ) }}</textarea>
                                    </div>


                                    <div class="well well-sm">
                                        <button type="submit" id="article-submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>保存</button>
                                    </div>
                                </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 side-bar">
            <div class="panel panel-default corner-radius help-box">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">构建高品质的社区</h3>
                </div>
                <div class="panel-body">
                    <ul class="list">
                        <li>请传播美好的事物，这里拒绝低俗、诋毁、谩骂等相关信息</li>
                        <li>请尽量分享技术相关的话题，谢绝发布社会, 政治等相关新闻</li>
                        <li>这里绝对不讨论任何有关盗版软件、音乐、电影如何获得的问题</li>
                </div>
            </div>

            <div class="panel panel-default corner-radius help-box">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">在高质量优秀社区的我们</h3>
                </div>
                <div class="panel-body">
                    <ul class="list">
                        <li>分享生活见闻, 分享知识</li>
                        <li>自发线下聚会, 加强社交</li>
                        <li>发现更好工作机会</li>
                        <li>甚至是开始另一个神奇的开源项目</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/editor.css') }}">
@stop
@section('scripts')
    <script type="text/javascript"  src="{{ asset('js/editor.js') }}"></script>

    <script type="text/javascript">
        $(function() {

            @if ( ! isset($article))
                localforage.getItem('article-title', function(err, value) {
                if ($('#article-title').val() == '' && !err) {
                    $('#article-title').val(value);
                };
            });
            $('#article-title').keyup(function(){
                localforage.setItem('article-title', $(this).val());
            });
                    @endif
            var simplemde = new SimpleMDE({
                    element: document.getElementById("body"),
                    spellChecker: false,
                    autosave: {
                        enabled: true,
                        delay: 5000,
                        unique_id: "article_content{{ isset($article) ? $article->id . '_' . str_slug($article->updated_at) : '' }}"
                    },
                    forceSync: true,
                    tabSize: 4,
                    toolbar: [
                        "bold", "italic", "heading", "|", "quote", "code", "table",
                        "horizontal-rule", "unordered-list", "ordered-list", "|",
                        "link", "image", "|",  "side-by-side", 'fullscreen', "|",
                        {
                            name: "guide",
                            action: function customFunction(editor){
                                var win = window.open('https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md', '_blank');
                                if (win) {
                                    //Browser has allowed it to be opened
                                    win.focus();
                                } else {
                                    //Browser has blocked it
                                    alert('Please allow popups for this website');
                                }
                            },
                            className: "fa fa-info-circle",
                            title: "Markdown 语法！",
                        },
                        {
                            name: "publish",
                            action: function customFunction(editor){
                                $('#article-submit').click();
                            },
                            className: "fa fa-paper-plane",
                            title: "发布文章",
                        }
                    ],
                });

            $('#link').hide();
            $('#link').children('input').attr('required',false);

            $('#authorSelect').hide();
            $('#authorSelect').children('select').attr('required',false);

            $('#typeSelect').change(function () {
                var index = $(this).children('option:selected').val();
                if(index==1){
                    $('#chapter').hide();
                    $('#note').hide();
                    $('#note').attr('required',false);

                    $('#chapter').children('select').attr('required',false);

                    $('#title').hide();
                    $('#title').children('input').attr('required',false);

                    $('#notice').hide();
                    $('#link').hide();
                    $('#link').children('input').attr('required',false);

                    $('#authorSelect').hide();
                    $('#authorSelect').children('select').attr('required',false);

                }else if(index==2) {
                    $('#chapter').hide();
                    $('#note').hide();
                    $('#note').attr('required',false);
                    $('#chapter').children('select').attr('required',false);

                    $('#notice').hide();
                    $('#title').show();
                    $('#title').children('input').attr('required',false);

                    $('#link').show();
                    $('#link').children('input').attr('required','required');

                    $('#authorSelect').show();
                    $('#authorSelect').children('input').attr('required','required');

                }else{
                    $('#chapter').show();
                    $('#note').show();

                    $('#chapter').children('select').attr('required','required');

                        $('#title').show();
                        $('#title').children('input').attr('required','required');

                        $('#notice').show();

                        $('#link').hide();
                        $('#link').children('input').attr('required',false);

                        $('#authorSelect').hide();
                        $('#authorSelect').children('select').attr('required',false);
                }
            });

            $("#typeSelect").trigger("change",[{{ $article->type }}]);

            $("#note").change(function () {
                $('#chapter_select').empty();
                var index = $(this).children('option:selected').val();
                $.get('{{route('chapters.getChapters')}}',{'note_id':index},function(msg){
                    var result = new Array();
                    var chapter_id = $('#chapter_id').val();
                    result = eval(msg);
                    var newhtml = '';
                    for(x in result)
                    {
                        var select = '';
                        if (chapter_id==result[x]['id']){
                            select = 'selected';
                        }
                        newhtml += "<option value="+"'"+result[x]['id']+"'"+select+">"+result[x]['name']+"</option>";
                    }
                    $('#chapter_select').append(newhtml);
                });
            });
            $("#note").trigger("change",[{{ $article->type }}]);
        });





    </script>
@stop
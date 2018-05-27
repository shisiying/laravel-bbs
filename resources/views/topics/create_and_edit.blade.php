@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-8 main-col">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <p>
                        <i class="glyphicon glyphicon-edit"></i> Topic /
                        @if($topic->id)
                            编辑话题
                        @else
                            新建话题
                        @endif
                    </p>
                </div>

                @include('common.error')
                <div class="alert alert-warning">
                    我们希望XHZ-XED社区能够成为拥有浓厚文化与geek氛围的高素质社区，而实现这个目标，需要我们所有人的共同努力：友善，公平，尊重知识和事实。请严格遵守 - 社区发帖和管理规范
                </div>
                <div class="panel-body">
                    @if($topic->id)
                        <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                            <input type="hidden" name="_method" value="PUT">
                            @else
                                <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                                    @endif

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                    <div class="form-group">
                                        <input class="form-control" id="topic-title" type="text" name="title" id="title-field" value="{{ old('title', $topic->title ) }}" placeholder="请填写标题" required />
                                    </div>


                                    <div class="form-group">
                                        <select class="form-control" name="category_id" required>
                                            <option value="" hidden disabled {{$topic->id?'':'selected'}}>请选择分类</option>
                                            @foreach($categories as $value)
                                                <option value="{{ $value->id }}" {{ $topic->category_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div id="reply_notice" class="box">
                                        <ul class="helpblock list">
                                            <li>请注意单词拼写，以及中英文排版，参考<a href="https://github.com/sparanoid/chinese-copywriting-guidelines">此页</a></li>
                                            <li>支持 Markdown 格式, **粗体**、~~删除线~~、`单行代码`, 更多语法请见这里 <a href="https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md">Markdown 语法</a></li>
                                            <li>支持表情，使用方法请见 <a href="https://laravel-china.org/topics/45" target="_blank">Emoji 自动补全来咯</a>，可用的 Emoji 请见 :metal: :point_right: <a href="https://laravel-china.org/ecc/index.html" target="_blank" rel="nofollow"> Emoji 列表 </a> :star: :sparkles: </li>
                                            <li>上传图片, 支持拖拽和剪切板黏贴上传, 格式限制 - jpg, png, gif</li>
                                            <li>发布框支持本地存储功能，会在内容变更时保存，「提交」按钮点击时清空</li>
                                        </ul>
                                    </div>

                                    <div class="form-group">
                                        <textarea name="body"  class="form-control" rows="3">{{ old('body', $topic->body ) }}</textarea>
                                    </div>


                                    <div class="well well-sm">
                                        <button type="submit" id="topic-submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>保存</button>
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

    <script>
        $(document).ready(function () {

            @if ( ! isset($topic))
                localforage.getItem('topic-title', function(err, value) {
                                if ($('#topic-title').val() == '' && !err) {
                                    $('#topic-title').val(value);
                                };
                            });
                            $('#topic-title').keyup(function(){
                                localforage.setItem('topic-title', $(this).val());
                            });
                    @endif
            var simplemde = new SimpleMDE({
                spellChecker: false,
                autosave: {
                    enabled: true,
                    delay: 5000,
                    unique_id: "topic_content{{ isset($topic) ? $topic->id . '_' . str_slug($topic->updated_at) : '' }}"
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
                            $('#topic-submit').click();
                        },
                        className: "fa fa-paper-plane",
                        title: "发布文章",
                    }
                ],
            });

        });
    </script>
@stop
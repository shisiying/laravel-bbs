<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;


// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function saving(Topic $topic)
    {
        //xss过滤
        $topic->body = clean($topic->body,'user_topic_body');
        $topic->excerpt = make_excerpt($topic->body);

        //如slug字段无内容，使用翻译器对title进行翻译
        if(!$topic->slug)
        {
            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        }
    }

}
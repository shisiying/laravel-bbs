<?php

namespace App\Observers;

use App\Models\Chapter;


// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ChapterObserver
{
    public function deleted(Chapter $chapter)
    {
        \DB::table('articles')->where('chapter_id',$chapter->id)->delete();
    }

}
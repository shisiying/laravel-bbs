<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\Note;


// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class NoteObserver
{
    public function deleted(Note $note)
    {
        $chapterIds = \DB::table('chapters')->where('note_id',$note->id)->pluck('id')->toArray();
        \DB::table('chapters')->where('note_id',$note->id)->delete();
        if (count($chapterIds)>1){
            \DB::delete('delete from articles where chapter_id in ?','('.implode(',',$chapterIds).')');
        }else{
            Article::query()->where('chapter_id',$chapterIds[0])->delete();
        }
    }

}
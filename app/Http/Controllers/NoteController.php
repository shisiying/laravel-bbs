<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Auth;

class NoteController extends Controller
{
    public function show(Note $note)
    {
        if ($note->is_recommended==1 || Auth::user()->hasPermissionTo('manage_contents')){
            return view('note.show',compact('note'));
        }else{
            abort('403','该笔记不存在！');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function purchase(Request $request)
    {
        if(is_numeric($request->note)){

            $note = Note::query()->find($request->note);

            if (!is_null($note) && $note->need_pay==1)
            {
                return view('order.index', compact('note'));
            } else{
                return redirect()->route('docs')->with('danger', '笔记找不到！');
            }

        }else{
            return redirect()->route('docs')->with('danger', '笔记找不到！');
        }

    }


}

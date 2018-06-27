<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    public function purchase(Request $request)
    {
        if(is_numeric($request->note)){

            $note = Note::query()->find($request->note);

            if (!is_null($note) && $note->need_pay==1)
            {
                //创建订单
                $orderInfos = Order::create([
                    'user_id'=>Auth::id(),
                    'total_amount'=>$note->price,
                    'note_id'=>$note->id,
                ]);
                return view('order.index', compact('note','orderInfos'));
            } else{
                return redirect()->route('docs')->with('danger', '笔记找不到！');
            }

        }else{
            return redirect()->route('docs')->with('danger', '笔记找不到！');
        }

    }


}

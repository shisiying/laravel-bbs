<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use Mockery\Exception;
use Pay;
use Yansongda\Pay\Log;

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

    public function alipayment(Order $order){
        //判断订单是否属于当前用户

        if (Order::own($order)){
            $order = [
                'out_trade_no'=>$order->no,
                'total_amount'=>$order->total_amount,
                'subject'=>$order->note->name,
            ];
            return Pay::alipay()->web($order);

        }else{
            abort('403','该订单不是你的！');
        }

    }



    public function alicallback()
    {
        try{
            $response = Pay::verify();
        }catch (Exception $e){
            return redirect()->route('docs')->with('danger', '支付验签不通过！');
        }
        $order = Order::query()->where('no','=',$response['out_trade_no'])->first();
        if (!is_null($order)){
            $order->payment_no = $response['trade_no'];
            $order->paid_at = $response['timestamp'];
            $order->payment_method = 'alipay';
            $order->status = 1;
            $order->update();
            return redirect()->route('notes',$order->note_id)->with('success', '购买成功，您可以阅读本笔记全部内容了。');
        }else{
            return redirect()->route('docs')->with('danger', '似乎没有找到你的订单，请联系管理员处理！');

        }
    }

    /**
     * ali 支付异步通知
     */
    public function alinotify()
    {
        try{
            $response = Pay::verify();
        }catch (Exception $e){
            Log::error('支付宝异步验签不通过！');
            return;
       }
        $order = Order::query()->where('no','=',$response['out_trade_no'])->first();
        if (!is_null($order)){
            $order->payment_no = $response['trade_no'];
            $order->paid_at = $response['timestamp'];
            $order->payment_method = 'alipay';
            $order->status = 1;
            $order->update();
        }else{
            Log::error('订单没找到！');

        }
    }
}

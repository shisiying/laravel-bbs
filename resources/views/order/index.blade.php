@extends('layouts.app')
@section('title', '查看订单')
@section('styles')
    <style>

        .preview{
            margin-right: 10px;
            float: left;
        }
        .product-info .product-title > a {
            color: #3c3c3c;
        }
        a {
            color: #3097D1;
            text-decoration: none;
        }
        .order-summary .text-right {
            text-align: right;
        }
        .value {
            display: inline-block;
            width: 100px;
            padding-right: 10px;
            margin-bottom: 10px;
        }
        .order-info{
            display: inline-block;
            float: left;
            width: 400px;

        }
    </style>

    @endsection

@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>订单详情</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>笔记信息</th>
                            <th class="text-center">单价</th>
                            <th class="text-center">数量</th>
                            <th class="text-right item-amount">小计</th>
                        </tr>
                        </thead>
                            <tr>
                                <td class="product-info">
                                    <div class="preview">
                                        <a target="_blank" href="{{route('notes',$note->id)}}">
                                            <img src="{{$note->cover}}?imageView2/1/w/80/h/60">
                                        </a>
                                    </div>
                                    <div>
                                        <p class="product-title">
                                           <a target="_blank" href="{{route('notes',$note->id)}}">{{ $note->name }}</a>
                                         </p>
                                            <span class="sku-title">{{ $note->description }}</span>
                                    </div>
                                </td>
                                <td class="sku-price text-center vertical-middle" style="vertical-align: middle;">￥{{ $note->price }}</td>
                                <td class="sku-amount text-center vertical-middle" style="vertical-align: middle;">1</td>
                                <td class="item-amount text-right vertical-middle" style="vertical-align: middle;">￥{{ $note->price }}</td>
                            </tr>
                        <tr><td colspan="4"></td></tr>
                    </table>


                    <div class="order-bottom">
                        <div class="order-info">
                            <div class="line"><div class="line-label">订单编号：</div><div class="line-value">{{ $orderInfos->no }}</div></div>
                        </div>
                        <div class="order-summary text-right">
                        <!-- 展示优惠信息结束 -->
                            <div class="total-amount">
                                <span>订单总价：</span>
                                <div class="value">￥{{ $note->price }}</div>
                            </div>

                            <div>
                                <span>订单状态：</span>
                                <div class="value">
                                        未支付
                                </div>
                            </div>
                        <!-- 支付按钮开始 -->
                            <div class="payment-buttons">
                                <a class="btn btn-primary btn-sm" href="{{route('order.alipay',$orderInfos)}}">支付宝支付</a>
                                {{--<button class="btn btn-sm btn-success" id='btn-wechat'>微信支付</button>--}}
                            </div>
                        <!-- 支付按钮结束 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


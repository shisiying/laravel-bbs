@extends('layouts.app')
@section('title','首页')

    @section('styles')
        <style>
            .topic-list .list-group-item .avatar.avatar-middle {
                width: 44px;
                height: 44px;
            }
            .list-group {
                margin-bottom: 0px;
            }
            .list-panel .panel-body {
                padding: 0px 15px;
            }
            .row {
                margin-right: -15px;
                margin-left: -15px;
            }
            .pricing-list-v4 {
                text-align: center;
                background: #fff;
                box-shadow: 0px 0px 25px -5px rgba(10, 10, 10, 1);
            }
            .pricing-list-v4 .pricing-list-v4-header {
                border-bottom: 1px solid #e4e8f3;
                padding: 10px;
                margin: 10px 30px;
            }
            .pricing-list-v4 .pricing-list-v4-content {
                padding: 40px 20px;
            }
            .pricing-list-v4 .pricing-list-v4-header .pricing-list-v4-title {
                font-size: 22px;
                margin-bottom: 5px;
            }
            .pricing-list-v4 .pricing-list-v4-header .pricing-list-v4-subtitle {
                display: block;
                font-size: 16px;
                font-weight: 300;
            }
            .pricing-list-v4 .pricing-list-v4-content .pricing-list-v4-price-sign {
                position: relative;
                top: -30px;
                font-size: 20px;
            }
            .center-block {
                display: block;
                margin-right: auto;
                margin-left: auto;
            }
            .btn-base-sm {
                font-size: 14px;
                font-weight: 300;
                padding: 9px 22px;
            }

            .btn-dark-brd {
                position: relative;
                display: inline-block;
                line-height: 1.4;
                color: #34343c;
                text-align: center;
                background: transparent;
                background-image: none;
                border-width: 1px;
                border-style: solid;
                border-color: #34343c;
                white-space: nowrap;
                vertical-align: middle;
                -ms-touch-action: manipulation;
                touch-action: manipulation;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            .works-item{
                margin-bottom: 50px;
                min-height: 147px;
            }
        </style>

    @stop

@section('content')
    <div class="container">


        <div class="row">
            <div class="heading-section col-md-12 text-center">
                <h3 class="panel-title text-center">小耳朵の作品</h3>
                <div class="separator-container">
                    <div class="separator line-separator">✻</div>
                </div>
                <p>热衷传统文化，有情怀，喜欢潮汕习俗！</p>
            </div>

        </div>
        <div class="container">
                <div class="works-list">
                    @foreach($works as $work)

                    <div class="col-md-3 col-sm-6 works-item">
                        <div class="card">
                            <div class="card-header ">
                               <h3>{{$work->title}}</h3>
                            </div>
                            <div class="card-block">
                                <p class="card-text">{!! $work->body !!}</p>
                                <a href="{{$work->link}}" class="btn btn-dark-brd">了解下</a>
                            </div>
                        </div>
                    </div>
                        @endforeach
                </div>

        </div>

        <br>
            <div class="row">
                <div class="heading-section col-md-12 text-center">
                    <h3 class="panel-title text-center">小猴子の开源项目</h3>
                    <div class="separator-container">
                        <div class="separator line-separator">✻</div>
                    </div>
                    <p>热衷开源精神，共同协作，与时俱进</p>
                </div>
            </div>

            <div class="row">
                @foreach($worksBySeven as $workBySeven)
                    <!-- End Pricing List v4 -->
                <div class="col-md-3 col-sm-6 md-margin-b-30" style="margin-bottom: 40px">
                    <!-- Pricing List v4 -->
                    <div class="pricing-list-v4 radius-10">
                        <div class="pricing-list-v4-header">
                            <h4 class="pricing-list-v4-title">{{$workBySeven->title}}</h4>
                            <div class="pricing-list-v4-subtitle">{!!$workBySeven->body!!}</div>
                        </div>
                        <div class="pricing-list-v4-content">
                            {{--<div class="margin-b-40">--}}
                                {{--<span class="pricing-list-v4-price-sign"><i class="fa fa-star"></i> 1800+</span>--}}
                            {{--</div>--}}
                            <div class="center-block">
                                <a href="{{$workBySeven->link}}" class="btn-dark-brd btn-base-sm radius-3"><i class="fa fa-github"></i> 访问项目</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Pricing List v4 -->
                </div>
                    @endforeach

            </div>
    </div>
@stop
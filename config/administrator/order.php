<?php

use App\Models\Order;

return [

    'title'   => '订单管理',
    'single'  => '订单管理',

    'model'   => Order::class,

    // 访问权限判断
    'permission'=> function()
    {
        // 只允许站长管理资源推荐链接
        return Auth::user()->hasRole('Founder');
    },

    'columns' => [
        'no' => [
            'title' => '订单号',
        ],
        'user_id' => [
            'title' => '用户',
            'output' => function ($name, $model) {

                return '<a href="/users/'.$model->user->id.'" target=_blank>'.$model->user->name.'</a>';
            },
        ],

        'total_amount' => [
            'title'    => '订单金额（单位元）',
        ],
        'note_id' => [
            'title' => '笔记名称',
            'output' => function ($note_id, $model) {

                return '<a href="/notes/'.$model->note->id.'" target=_blank>'.$model->note->name.'</a>';
            },
        ],
        'payment_method'=>[
            'title'=> '支付方式',
        ],
        'status'=>[
            'title'=> '支付状态',
            'output' => function ($status, $model) {
                return $status==0 ?'未支付':'已支付';
            },

        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    // 『模型表单』设置项
    'edit_fields' => [
        'user'=>[
                'title'              => '用户',
                'type'               => 'relationship',
                'name_field'         => 'name',
                'autocomplete'       => true,
                'search_fields'      => array("CONCAT(id, ' ', name)"),
                'options_sort_field' => 'id',
        ],
        'note'=>[
            'title'              => '笔记',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'total_amount'=>[
            'title'=>'金额',
        ],
        'payment_method'=>[
            'title'=>'支付方式',
            'type'=>'enum',
            'options'  => [
                'alipay','weixin'
            ],
        ],
        'status'=>[
            'title' =>'是否支付',
            'type'=>'enum',
            'options'  => [
                '0','1'
            ],
        ],
    ],
    'filters' => [
        'no' => [
            'title' => '订单号',
        ],
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'note'=>[
            'title'              => '笔记',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],
        'payment_method'=>[
            'title'=>'支付方式',
            'type'=>'enum',
            'options'  => [
                'alipay','weixin'
            ],
        ],
        'status'=>[
            'title' =>'是否支付',
            'type'=>'enum',
            'options'  => [
                '0','1'
            ],
        ],
    ]
];
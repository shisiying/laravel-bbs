<?php
use App\Models\Note;

return [
    'title'   => '笔记类目',
    'single'  => '笔记类目创建',
    'model'   => Note::class,
    // 访问权限判断
    'permission'=> function()
    {
        // 只允许站长管理资源推荐链接
        return Auth::user()->hasRole('Founder');
    },
    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name'=>[
            'title' =>'笔记名字',
        ],
        'description'=>[
            'title' =>'笔记描述',
            'sortable' => false,

        ],
        'cover'=>[
            'title' =>'封面图',
            'sortable' => false,
            'output'   => function ($value, $model) {
                return $value ? "<img src='$value' width='200' height='100'>" : 'N/A';
            },
        ],
        'is_recommended'=>[
            'title' =>'是否显示',
            'sortable' => false,
        ],
        'created_at',
        'operation' => [
            'title'  => '管理',
            'output' => function ($value, $model) {
                return $value;
            },
            'sortable' => false,
        ],

    ],
    'edit_fields' => [

        'name'=>[
            'title' =>'笔记名字',
            'type'=>'text'
        ],
        'description' => [
            'title' => '描述',
            'type'  => 'textarea',
        ],
        'cover'=>[
            'title'=>'封面图(七牛图片链接)',
            'type'=>'text'
        ],
        'is_recommended'=>[
            'title' =>'是否显示',
            'type'=>'enum',
            'options'  => [
                '0','1'
            ],
        ],
    ],
    'filters' => [
        'name' => [
            'title' => '名称',
        ],
    ]
];
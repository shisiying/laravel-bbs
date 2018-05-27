<?php

use App\Models\Chapter;
use App\Models\Note;

return [

    'title'   => '新建笔记章节',
    'single'  => '新建笔记章节',

    'model'   => Chapter::class,

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
        'name' => [
            'title' => '章节名称',
        ],

        'note' => [
            'title'    => '所属笔记',
            'sortable' => false,
            'output'   => function ($value, $model) {
                $note_id = $model->note->id;
                $note = $model->note->name;
                return '名字: '.$note.'-'.'id: '.$note_id;
            },
        ],
        'operation' => [
            'title'  => '管理',
            'output' => function ($value, $model) {
                return $value;
            },
            'sortable' => false,
        ],
    ],
    'edit_fields' => [

        'name' => [
            'title'    => '章节名称',
        ],

        'note' => [
            'title'              => '笔记',
            'type'               => 'relationship',
            'name_field'         => 'name',

            // 自动补全，对于大数据量的对应关系，推荐开启自动补全，
            // 可防止一次性加载对系统造成负担
            'autocomplete'       => true,

            // 自动补全的搜索字段
            'search_fields'      => ["CONCAT(id, ' ', name)"],

            // 自动补全排序
            'options_sort_field' => 'id',
        ],

    ],
    'filters' => [
        'id' => [
            'title' => '章节 ID',
        ],
        'note' => [
            'title'              => '笔记',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
        ],
    ],
];
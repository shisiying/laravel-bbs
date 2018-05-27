<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedNoteChapterData extends Migration
{
    public function up()
    {
        $notes = [
            [
                'name' => '生活',
                'description' => '生活状态专栏',
                'cover' => 'https://dn-phphub.qbox.me/uploads/banners/qCpz5a1iBETEfnNEAkGe.png',
                'is_recommended' => 0
            ],
            [
                'name' => '作品集',
                'description' => '小猴子与小耳朵的作品集',
                'cover' => 'https://dn-phphub.qbox.me/uploads/banners/EptWCkT1qDDvtn5nV2id.png',
                'is_recommended' => 0
            ],
        ];

        DB::table('notes')->insert($notes);

        $chapters = [
            [
                'name'=>'生活',
                'note_id'=>1,
            ],
            [
                'name'=>'作品集',
                'note_id'=>2
            ],
            [
                'name'=>'关于',
                'note_id'=>2
            ]
        ];
        DB::table('chapters')->insert($chapters);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}

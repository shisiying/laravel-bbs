<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name'=>'writeup',
                'description'=>'分享发现,分享创造'
            ],
            [
                'name' =>'教程资料',
                'description'=>'渗透技巧'
            ],
            [
                'name' =>'问答',
                'description'=>'请保持友善，互帮互助'
            ],
            [
                'name' =>'公告',
                'description'=>'站点公告'
            ],
        ];

        DB::table('categories')->insert($categories);
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

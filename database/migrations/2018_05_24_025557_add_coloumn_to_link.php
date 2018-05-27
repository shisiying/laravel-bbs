<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColoumnToLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('links', function (Blueprint $table) {
            $table->string('position')->nullable()->index();
            $table->integer('order')->nullable()->unsigned()->default(0)->index();
            $table->string('image_url')->nullable();
            $table->enum('target', ['_blank',  '_self'])->nullable()->default('_blank')->index();
            $table->text('description')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->dropColumn('order');
            $table->dropColumn('image_url');
            $table->dropColumn('target');
            $table->dropColumn('description');
        });
    }
}

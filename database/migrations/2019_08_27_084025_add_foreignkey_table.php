<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('bookmark_categories', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('bookmarks', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('bookmark_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('bookmark_categories', function (Blueprint $table) {
            $table->dropForeign('bookmark_categories_user_id_foreign');
        });

        Schema::table('bookmarks', function (Blueprint $table) {

            $table->dropForeign('bookmarks_user_id_foreign');
            $table->dropForeign('bookmarks_category_id_foreign');

        });
    }
}

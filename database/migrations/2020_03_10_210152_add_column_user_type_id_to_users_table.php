<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUserTypeIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            // llave foranea para id del tipo de usuario
            $table->integer('user_type_id')->unsigned();
            $table->foreign('user_type_id')
                ->references('id')->on('user_types')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_user_type_id_foreign');
            $table->dropColumn('user_type_id');
        });
    }
}

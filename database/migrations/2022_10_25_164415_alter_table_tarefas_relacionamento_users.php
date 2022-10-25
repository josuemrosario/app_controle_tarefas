<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTarefasRelacionamentoUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //aula 225
        Schema::table('tarefas',function(Blueprint $table){
            $table->unsignedBiginteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //aula 225
        Schema::table('tarefas',function(Blueprint $table){
            $table->dropforeign('tarefas_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}

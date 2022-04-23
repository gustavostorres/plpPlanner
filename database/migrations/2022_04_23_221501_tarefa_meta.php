<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TarefaMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarefaMeta', function (Blueprint $table)  {
            $table->id();
            $table->unsignedBigInteger('meta_id');
            $table->foreign('meta_id')->references('id')->on('metas');
            $table->unsignedBigInteger('tarefa_id');
            $table->foreign('tarefa_id')->references('id')->on('tarefas');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarefaMeta');
    }
}

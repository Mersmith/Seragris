<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('slug');
            $table->text('descripcion');
            $table->longText('cuerpo');
            $table->enum('estado', [1, 2])->default(1);
            $table->unsignedBigInteger('categoria_blog_id');
            $table->foreign('categoria_blog_id')->references('id')->on('categoria_blogs')->onDelete('cascade');

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
        Schema::dropIfExists('posts');
    }
};

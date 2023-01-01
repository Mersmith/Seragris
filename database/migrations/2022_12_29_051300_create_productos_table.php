<?php

use App\Models\Producto;
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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('subcategoria_id');
            $table->unsignedBigInteger('marca_id');

            $table->string('nombre');
            $table->string('slug')->unique();
            $table->float('precio');
            $table->float('precio_real');
            $table->text('descripcion');
            $table->text('informacion')->nullable();
            $table->text('controla')->nullable();
            $table->text('cultivos')->nullable();
            $table->text('ingredientes')->nullable();
            $table->enum('estado', [Producto::BORRADOR, Producto::PUBLICADO])->default(Producto::BORRADOR);

            $table->foreign('subcategoria_id')->references('id')->on('subcategorias')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');

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
        Schema::dropIfExists('productos');
    }
};

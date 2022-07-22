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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boutique_id')->constrained();
            $table->foreignId('pour_id')->constrained();
            $table->foreignId('categorie_id')->constrained();
            $table->foreignId('modele_id')->constrained();
            $table->double('prix');
            $table->string('commentaire');
            $table->boolean('valide')->default(1);
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
        Schema::dropIfExists('articles');
    }
};

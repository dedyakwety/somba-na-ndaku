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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('livreur_id')->nullable();
            $table->integer('achat_numero');
            $table->date('date_livraison');
            $table->string('heure_livraison');
            $table->mediumText('adresse_livraison');
            $table->integer('nombre_article');
            $table->double('prix_total');
            $table->double('remise_pourcentage');
            $table->double('remise');
            $table->double('montant_remise')->nullable();
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
        Schema::dropIfExists('livraisons');
    }
};

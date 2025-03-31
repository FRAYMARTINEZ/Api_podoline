<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attentions', function (Blueprint $table) {
            $table->id();

            $table->date('appointment_date'); // Fecha de atención
            $table->integer('shoe_size'); // Talla de zapato

            // Imágenes
            $table->string('back_standing_up_image');
            $table->string('back_45_image');
            $table->string('back_toes_up_image');
            $table->string('from_chaplin_image');
            $table->string('from_chaplin_toes_up_image');
            $table->string('with_insoles_image');

            $table->string('footstep_type_left'); // Tipo pisada Izq
            $table->string('footstep_type_right'); // Tipo pisada Der

            $table->string('foot_type_left'); // Tipo Pie Izq
            $table->string('foot_type_right'); // Tipo Pie Der

            $table->string('heel_type_left'); // Tipo Talón Izq
            $table->string('heel_type_right'); // Tipo Talón Der

            $table->text('observations')->nullable(); // Observaciones

            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attentions');
    }
};

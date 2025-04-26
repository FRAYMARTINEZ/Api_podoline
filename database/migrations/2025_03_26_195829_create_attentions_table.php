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
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreignId('office_id')->constrained('consulting_offices')->onDelete('cascade');

            $table->date('appointment_date')->default(now()); // Fecha de atención
            $table->integer('shoe_size')->nullable(); // Talla de zapato

            $table->string('footstep_type_left')->default('NEUTRO'); // Tipo pisada Izq
            $table->string('footstep_type_right')->default('NEUTRO'); // Tipo pisada Der

            $table->string('foot_type_left')->default('NEUTRO'); // Tipo Pie Izq
            $table->string('foot_type_right')->default('NEUTRO'); // Tipo Pie Der

            $table->string('heel_type_left')->default('NEUTRO'); // Tipo Talón Izq
            $table->string('heel_type_right')->default('NEUTRO'); // Tipo Talón Der

            $table->text('observations')->nullable(); // Observaciones
            $table->text('extra')->nullable();
            $table->text('side')->nullable();
            // Relaciones (si usas claves foráneas)
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
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

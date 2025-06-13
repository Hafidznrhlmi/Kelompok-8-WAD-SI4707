<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('status')->default('scheduled');
            $table->string('queue_number');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Add unique constraint to prevent double booking
            $table->unique(['doctor_id', 'appointment_date', 'appointment_time']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
?>
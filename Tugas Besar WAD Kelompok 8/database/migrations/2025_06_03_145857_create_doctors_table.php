<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('name');
            $table->string('specialization');
            $table->text('short_description');
            $table->text('full_description');
            $table->string('status')->default('active');
            $table->date('joined_date');
            $table->time('practice_start_time')->default('09:00:00');
            $table->time('practice_end_time')->default('20:00:00');
            $table->string('practice_days')->default('Senin - Jumat');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};
?>
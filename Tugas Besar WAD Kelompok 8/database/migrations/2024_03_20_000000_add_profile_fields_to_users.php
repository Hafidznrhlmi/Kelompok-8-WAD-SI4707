<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo')->nullable()->after('email');
            $table->string('phone_number')->nullable()->after('profile_photo');
            $table->text('address')->nullable()->after('phone_number');
            $table->date('date_of_birth')->nullable()->after('address');
            $table->enum('gender', ['male', 'female'])->nullable()->after('date_of_birth');
            $table->text('bio')->nullable()->after('gender');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_photo',
                'phone_number',
                'address',
                'date_of_birth',
                'gender',
                'bio'
            ]);
        });
    }
}; 
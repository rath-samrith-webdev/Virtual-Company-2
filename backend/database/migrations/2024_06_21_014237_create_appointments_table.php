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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->date('appointment_date');
            $table->date('appointment_end')->nullable();
            $table->time('appointment_time');
            $table->enum('status', ['Pending','Canceled','Missing', 'Confirmed', 'Rejected'])->default('Pending');
            $table->enum('hospital_status', ['Pending','Canceled','Missing', 'Confirmed', 'Rejected'])->default('Pending');
            $table->enum('doctor_status', ['Pending','Canceled','Missing', 'Confirmed', 'Rejected'])->default('Pending');
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

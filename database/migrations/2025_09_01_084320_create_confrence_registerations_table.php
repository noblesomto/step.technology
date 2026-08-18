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
        Schema::create('conference_registrations', function (Blueprint $table) {
            $table->id();
            $table->enum('title', ['Mr.', 'Ms.', 'Mrs.', 'Engr.', 'Dr.', 'Prof.']);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('phone', 20);
            $table->string('email', 150);
            $table->string('organization', 200);
            $table->string('country', 100);
            $table->enum('category', ['Delegate', 'Visitor', 'Volunteer', 'Govt Official', 'Speaker', 'Student', 'Exhibitor']);
            $table->text('message')->nullable();
            $table->string('registration_id')->unique()->nullable();
            $table->text('payment')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();

            // Indexes for better performance
            $table->index('email');
            $table->index('category');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conference_registrations');
    }
};

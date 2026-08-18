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
        // Check if table exists
        if (!Schema::hasTable('exam_progress')) {
            // Create new table
            Schema::create('exam_progress', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('exam_session_id')->unique();
                $table->timestamp('start_time');
                $table->integer('current_question')->default(0);
                $table->integer('time_remaining'); // in seconds
                $table->json('answers')->nullable();
                $table->boolean('is_complete')->default(false);
                $table->timestamp('last_saved_at')->nullable();
                $table->timestamp('completed_at')->nullable();
                $table->timestamps();
            });
        } else {
            // Update existing table - add missing columns
            Schema::table('exam_progress', function (Blueprint $table) {
                // Only add columns if they don't exist
                if (!Schema::hasColumn('exam_progress', 'exam_session_id')) {
                    $table->string('exam_session_id')->unique()->after('user_id');
                }
                if (!Schema::hasColumn('exam_progress', 'start_time')) {
                    $table->timestamp('start_time')->after('exam_session_id');
                }
                if (!Schema::hasColumn('exam_progress', 'current_question')) {
                    $table->integer('current_question')->default(0)->after('start_time');
                }
                if (!Schema::hasColumn('exam_progress', 'time_remaining')) {
                    $table->integer('time_remaining')->after('current_question');
                }
                if (!Schema::hasColumn('exam_progress', 'answers')) {
                    $table->json('answers')->nullable()->after('time_remaining');
                }
                if (!Schema::hasColumn('exam_progress', 'is_complete')) {
                    $table->boolean('is_complete')->default(false)->after('answers');
                }
                if (!Schema::hasColumn('exam_progress', 'last_saved_at')) {
                    $table->timestamp('last_saved_at')->nullable()->after('is_complete');
                }
                if (!Schema::hasColumn('exam_progress', 'completed_at')) {
                    $table->timestamp('completed_at')->nullable()->after('last_saved_at');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_progress');
    }
};

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
        if (!Schema::hasTable('exam_scores')) {
            // Create new table
            Schema::create('exam_scores', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('exam_session_id');
                $table->integer('score')->default(0);
                $table->integer('total_questions')->default(40);
                $table->json('answers')->nullable();
                $table->integer('time_taken')->nullable(); // in seconds
                $table->timestamp('submitted_at')->nullable();
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
                $table->text('admin_notes')->nullable();
                $table->timestamps();
            });
        } else {
            // Update existing table - add missing columns
            Schema::table('exam_scores', function (Blueprint $table) {
                // Only add columns if they don't exist
                if (!Schema::hasColumn('exam_scores', 'exam_session_id')) {
                    $table->string('exam_session_id')->after('user_id');
                }
                if (!Schema::hasColumn('exam_scores', 'total_questions')) {
                    $table->integer('total_questions')->default(40)->after('score');
                }
                if (!Schema::hasColumn('exam_scores', 'answers')) {
                    $table->json('answers')->nullable()->after('total_questions');
                }
                if (!Schema::hasColumn('exam_scores', 'time_taken')) {
                    $table->integer('time_taken')->nullable()->after('answers');
                }
                if (!Schema::hasColumn('exam_scores', 'submitted_at')) {
                    $table->timestamp('submitted_at')->nullable()->after('time_taken');
                }
                if (!Schema::hasColumn('exam_scores', 'status')) {
                    $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('submitted_at');
                }
                if (!Schema::hasColumn('exam_scores', 'admin_notes')) {
                    $table->text('admin_notes')->nullable()->after('status');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_scores');
    }
};

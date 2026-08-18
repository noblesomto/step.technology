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
        // Update exam_progress table
        if (Schema::hasTable('exam_progress')) {
            Schema::table('exam_progress', function (Blueprint $table) {
                if (!Schema::hasColumn('exam_progress', 'exam_session_id')) {
                    $table->string('exam_session_id')->nullable()->after('user_id');
                }
                if (!Schema::hasColumn('exam_progress', 'start_time')) {
                    $table->timestamp('start_time')->nullable()->after('exam_session_id');
                }
                if (!Schema::hasColumn('exam_progress', 'current_question')) {
                    $table->integer('current_question')->default(0)->after('start_time');
                }
                if (!Schema::hasColumn('exam_progress', 'time_remaining')) {
                    $table->integer('time_remaining')->nullable()->after('current_question');
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
        } else {
            Schema::create('exam_progress', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('exam_session_id')->unique();
                $table->timestamp('start_time');
                $table->integer('current_question')->default(0);
                $table->integer('time_remaining');
                $table->json('answers')->nullable();
                $table->boolean('is_complete')->default(false);
                $table->timestamp('last_saved_at')->nullable();
                $table->timestamp('completed_at')->nullable();
                $table->timestamps();
            });
        }

        // Update exam_scores table
        if (Schema::hasTable('exam_scores')) {
            Schema::table('exam_scores', function (Blueprint $table) {
                if (!Schema::hasColumn('exam_scores', 'exam_session_id')) {
                    $table->string('exam_session_id')->nullable()->after('user_id');
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
                    $table->string('status')->default('pending')->after('submitted_at');
                }
                if (!Schema::hasColumn('exam_scores', 'admin_notes')) {
                    $table->text('admin_notes')->nullable()->after('status');
                }
            });
        } else {
            Schema::create('exam_scores', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('exam_session_id');
                $table->integer('score')->default(0);
                $table->integer('total_questions')->default(40);
                $table->json('answers')->nullable();
                $table->integer('time_taken')->nullable();
                $table->timestamp('submitted_at')->nullable();
                $table->string('status')->default('pending');
                $table->text('admin_notes')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop columns we added, not the entire table
        if (Schema::hasTable('exam_progress')) {
            Schema::table('exam_progress', function (Blueprint $table) {
                $columns = ['exam_session_id', 'start_time', 'current_question', 'time_remaining',
                           'answers', 'is_complete', 'last_saved_at', 'completed_at'];
                foreach ($columns as $column) {
                    if (Schema::hasColumn('exam_progress', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        if (Schema::hasTable('exam_scores')) {
            Schema::table('exam_scores', function (Blueprint $table) {
                $columns = ['exam_session_id', 'total_questions', 'answers', 'time_taken',
                           'submitted_at', 'status', 'admin_notes'];
                foreach ($columns as $column) {
                    if (Schema::hasColumn('exam_scores', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};

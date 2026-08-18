<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * exam_session_id was declared required in the original migration, but
     * the live column is actually nullable — scores an admin creates or
     * edits directly don't always have an exam_session_id. Drop + re-add
     * instead of ->change() (needs doctrine/dbal, not installed here).
     */
    public function up(): void
    {
        Schema::table('exam_scores', function (Blueprint $table) {
            $table->dropColumn('exam_session_id');
        });
        Schema::table('exam_scores', function (Blueprint $table) {
            $table->string('exam_session_id')->nullable()->after('exam_batch_id');
        });
    }

    public function down(): void
    {
        Schema::table('exam_scores', function (Blueprint $table) {
            $table->dropColumn('exam_session_id');
        });
        Schema::table('exam_scores', function (Blueprint $table) {
            $table->string('exam_session_id')->after('exam_batch_id');
        });
    }
};

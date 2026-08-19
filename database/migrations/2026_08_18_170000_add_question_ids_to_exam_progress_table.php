<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The question set shown to a candidate must be pinned for the life of
     * their session — previously it was re-randomized on every page load,
     * so a reload would silently swap in a different set of questions
     * while restoring answers by index against the new (wrong) set.
     */
    public function up()
    {
        Schema::table('exam_progress', function (Blueprint $table) {
            $table->json('question_ids')->nullable()->after('exam_session_id');
            $table->foreignId('exam_batch_id')->nullable()->after('user_id')->constrained()->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('exam_progress', function (Blueprint $table) {
            $table->dropConstrainedForeignId('exam_batch_id');
            $table->dropColumn('question_ids');
        });
    }
};

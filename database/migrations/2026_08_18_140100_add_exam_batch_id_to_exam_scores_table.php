<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exam_scores', function (Blueprint $table) {
            $table->foreignId('exam_batch_id')->nullable()->after('user_id')->constrained()->nullOnDelete();
        });

        // Backfill: every score that existed before batches existed belongs
        // to the sitting they were actually submitted for (Oct–Nov 2025,
        // per the data). Left inactive — it's history, not the open sitting.
        if (DB::table('exam_scores')->whereNull('exam_batch_id')->exists()) {
            $legacyBatchId = DB::table('exam_batches')->insertGetId([
                'name' => 'ICTES 2025 Sitting',
                'description' => 'Backfilled from scores submitted before exam batches existed.',
                'starts_at' => '2025-10-01',
                'ends_at' => '2025-11-30',
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('exam_scores')->whereNull('exam_batch_id')->update(['exam_batch_id' => $legacyBatchId]);
        }
    }

    public function down(): void
    {
        Schema::table('exam_scores', function (Blueprint $table) {
            $table->dropConstrainedForeignId('exam_batch_id');
        });
    }
};

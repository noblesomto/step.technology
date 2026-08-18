<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Brings the users migration back in sync with the live schema.
     * These columns exist on the production/local database already
     * (added directly at some point, never captured in a migration) —
     * this closes that drift so `migrate:fresh` reproduces reality.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('school_faculty')->nullable()->after('school_name');
            $table->string('school_dept')->nullable()->after('school_faculty');
            $table->text('referee_name')->nullable()->after('member_status');
            $table->string('referee_phone', 50)->nullable()->after('referee_name');
            $table->string('referee_email', 250)->nullable()->after('referee_phone');
            $table->text('referee_address')->nullable()->after('referee_email');
            $table->enum('exam_taken', ['yes', 'no'])->default('no')->after('remember_token');
        });

        // member_status was defined as required in the original migration,
        // but the live column is actually nullable (users aren't assigned
        // a membership status until after payment). Drop + re-add instead
        // of ->change(), since that needs doctrine/dbal which isn't
        // installed here.
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('member_status');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('member_status')->nullable()->after('profession');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'school_faculty',
                'school_dept',
                'referee_name',
                'referee_phone',
                'referee_email',
                'referee_address',
                'exam_taken',
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('member_status');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('member_status')->after('profession');
        });
    }
};

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
        Schema::table('applicants', function (Blueprint $table) {
            // $table->unsignedBigInteger('branch_id')->nullable()->after('card_id');
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

            // $table->json('sub_branch_ids')->nullable()->after('branch_id');
            // $table->json('sub_sub_branch_ids')->nullable()->after('sub_branch_ids');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['sub_branch_ids']);
            $table->dropForeign(['sub_sub_branch_ids']);
        });
    }
};

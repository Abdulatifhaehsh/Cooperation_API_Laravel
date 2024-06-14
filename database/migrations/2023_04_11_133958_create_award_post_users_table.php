<?php

use App\Models\AwardPostUser;
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
        Schema::create(AwardPostUser::table, function (Blueprint $table) {
            $table->id();
            $table->foreignId(AwardPostUser::userId)->constrained();
            $table->foreignId(AwardPostUser::postId)->constrained();
            $table->foreignId(AwardPostUser::awardId)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(AwardPostUser::table);
    }
};

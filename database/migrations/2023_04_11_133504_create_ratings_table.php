<?php

use App\Models\Rating;
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
        Schema::create(Rating::table, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Rating::userId)->constrained();
            $table->foreignId(Rating::activityId)->constrained();
            $table->unsignedInteger(Rating::starCount);
            $table->string(Rating::comment);
            $table->index([Rating::userId, Rating::activityId]);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Rating::table);
    }
};

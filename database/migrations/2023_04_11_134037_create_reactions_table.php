<?php

use App\Models\Reaction;
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
        Schema::create(Reaction::table, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Reaction::userId)->constrained();
            $table->foreignId(Reaction::postId)->nullable()->constrained();
            $table->foreignId(Reaction::commentId)->nullable()->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Reaction::table);
    }
};

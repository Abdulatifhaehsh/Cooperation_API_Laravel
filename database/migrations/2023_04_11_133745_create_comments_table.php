<?php

use App\Models\Comment;
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
        Schema::create(Comment::table, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Comment::userId)->constrained();
            $table->foreignId(Comment::postId)->nullable()->constrained();
            $table->foreignId(Comment::commentId)->nullable()->constrained();
            $table->string(Comment::comment);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Comment::table);
    }
};

<?php

use App\Models\Post;
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
        Schema::create(Post::table, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Post::userId)->constrained();
            $table->foreignId(Post::tagId)->nullable()->constrained();
            $table->foreignId(Post::awardId)->nullable()->constrained();
            $table->string(Post::title);
            $table->string(Post::description);
            $table->boolean(Post::isAccepted)->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Post::table);
    }
};

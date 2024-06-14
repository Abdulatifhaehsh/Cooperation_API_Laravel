<?php

use App\Models\Purchase;
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
        Schema::create(Purchase::table, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Purchase::userId)->constrained();
            $table->foreignId(Purchase::itemId)->constrained();
            $table->integer(Purchase::value);
            $table->integer(Purchase::quantity);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Purchase::table);
    }
};

<?php

use App\Models\Item;
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
        Schema::create(Item::table, function (Blueprint $table) {
            $table->id();
            $table->string(Item::description)->nullable();
            $table->string(Item::title)->nullable();
            $table->string(Item::image)->nullable();
            $table->integer(Item::value);
            $table->integer(Item::quantity);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Item::table);
    }
};

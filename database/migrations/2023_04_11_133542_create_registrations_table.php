<?php

use App\Models\Registration;
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
        Schema::create(Registration::table, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Registration::userId)->constrained();
            $table->foreignId(Registration::activityId)->constrained();
            $table->index([Registration::userId, Registration::activityId]);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Registration::table);
    }
};

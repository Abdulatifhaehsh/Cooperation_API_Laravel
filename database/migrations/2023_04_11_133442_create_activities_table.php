<?php

use App\Models\Activity;
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
        Schema::create(Activity::table, function (Blueprint $table) {
            $table->id();
            $table->string(Activity::title);
            $table->string(Activity::image);
            $table->dateTime(Activity::beginAt);
            $table->dateTime(Activity::endAt);
            $table->string(Activity::description);
            $table->dateTime(Activity::registrationEnd);
            $table->string(Activity::location);
            $table->integer(Activity::maxMembers);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Activity::table);
    }
};

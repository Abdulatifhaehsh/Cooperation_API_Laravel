<?php

use App\Enums\UserType;
use App\Models\User;
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
        Schema::create(User::table, function (Blueprint $table) {
            $table->id();
            $table->string(User::firstName);
            $table->string(User::lastName);
            $table->foreignId(User::departmentId)->constrained();
            $table->enum(User::userType, UserType::getValues())->default(UserType::user);
            $table->string(User::username)->unique();
            $table->string(User::password);
            $table->char(User::phoneNumber)->unique();
            $table->string(User::image)->nullable();
            $table->integer(User::wallet)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(User::table);
    }
};

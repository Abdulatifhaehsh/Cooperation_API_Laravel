<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table(User::table)->truncate();
        DB::statement("SET foreign_key_checks=1");

        DB::table(User::table)->insert([
            [
                User::firstName => 'Abdulatif',
                User::lastName => 'Hashash',
                User::username => 'abdo',
                User::password => Hash::make('admin123'),
                User::phoneNumber => '0949945257',
                User::departmentId => 2,
                User::userType => UserType::admin,
                User::createdAt => Carbon::now(),
                User::updatedAt => Carbon::now(),
            ],
            [
                User::firstName => 'Admin',
                User::lastName => 'Admin',
                User::username => 'admin',
                User::password => Hash::make('admin123'),
                User::phoneNumber => '0949945258',
                User::departmentId => 1,
                User::userType => UserType::admin,
                User::createdAt => Carbon::now(),
                User::updatedAt => Carbon::now(),
            ]

        ]);
    }
}

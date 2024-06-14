<?php

namespace Database\Seeders;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table(Department::table)->truncate();
        DB::statement("SET foreign_key_checks=1");

        DB::table(Department::table)->insert([
            [
                Department::section => 'HR',
                Department::createdAt => Carbon::now(),
                Department::updatedAt => Carbon::now(),
            ],
            [
                Department::section => 'SEO',
                Department::createdAt => Carbon::now(),
                Department::updatedAt => Carbon::now(),
            ],
            [
                Department::section => 'BACKEND',
                Department::createdAt => Carbon::now(),
                Department::updatedAt => Carbon::now(),
            ],
            [
                Department::section => 'FRONTEND',
                Department::createdAt => Carbon::now(),
                Department::updatedAt => Carbon::now(),
            ],

        ]);
    }
}

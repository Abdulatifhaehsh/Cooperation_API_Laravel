<?php

namespace Database\Seeders;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table(Tag::table)->truncate();
        DB::statement("SET foreign_key_checks=1");

        DB::table(Tag::table)->insert([
            [
                Tag::name => 'Award',
                Tag::isAdmin => false,
                Tag::createdAt => Carbon::now(),
                Tag::updatedAt => Carbon::now(),
            ],
            [
                Tag::name => 'Announcement',
                Tag::isAdmin => true,
                Tag::createdAt => Carbon::now(),
                Tag::updatedAt => Carbon::now(),
            ],
            [
                Tag::name => 'Backend',
                Tag::isAdmin => false,
                Tag::createdAt => Carbon::now(),
                Tag::updatedAt => Carbon::now(),
            ],
            [
                Tag::name => 'Frontend',
                Tag::isAdmin => false,
                Tag::createdAt => Carbon::now(),
                Tag::updatedAt => Carbon::now(),
            ],
            [
                Tag::name => 'Core team',
                Tag::isAdmin => false,
                Tag::createdAt => Carbon::now(),
                Tag::updatedAt => Carbon::now(),
            ],

        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'Inspirational Quotes',
            'slug' => 'inspirational-quotes'
        ]);

        DB::table('quote_types')->insert([
            'name' => 'Pure Quote',
            'slug' => 'pure-quote'
        ]);
        DB::table('quote_types')->insert([
            'name' => 'Direct Quote',
            'slug' => 'direct-quote'
        ]);
        DB::table('quote_types')->insert([
            'name' => 'Indirect Quote',
            'slug' => 'indirect-quote'
        ]);
        DB::table('quote_types')->insert([
            'name' => 'Mixed Quote',
            'slug' => 'mixed-quote'
        ]);
    }
}

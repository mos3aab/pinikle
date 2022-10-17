<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            // 'id'=>1,
            'name' => 'Iphone 14 pro Max',
            'price' => 1200,
            'stock' => 5,
            'status' => 'Available',
        ]);

        DB::table('products')->insert([
            // 'id'=>2,
            'name' => 'Iphone 14 pro',
            'price' => 1000,
            'stock' => 12,
            'status' => 'Available',
        ]);

        DB::table('products')->insert([
            // 'id'=>3,
            'name' => 'Iphone 14 Plus',
            'price' => 900,
            'stock' => 10,
            'status' => 'Available',
        ]);

        DB::table('products')->insert([
            // 'id'=>4,
            'name' => 'Iphone 14',
            'price' => 800,
            'stock' => 7,
            'status' => 'Available',
        ]);
    }
}

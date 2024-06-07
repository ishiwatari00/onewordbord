<?php

namespace Database\Seeders;

use App\Models\Threadcmt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class threadcmtsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Threadcmt::factory(50)->create();
    }
}

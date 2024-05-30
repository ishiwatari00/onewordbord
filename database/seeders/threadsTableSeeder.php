<?php

namespace Database\Seeders;

use App\Models\Thread;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class threadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Thread::factory(10)->create();
         $this->call(threadsTableSeeder::class);
    }
}

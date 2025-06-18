<?php

namespace Database\Seeders;

use App\Models\Pin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Pin::create([
            'id' => 1,
            'cronograma_id' => 348511,
            'pin' => 5248,
        ]);
    }
}

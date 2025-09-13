<?php

namespace Database\Seeders;

use App\Models\payment_categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class payment_categories_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        payment_categories::create([
            'name'=>'Test Receiving Category',
            'for'=>'Receive',
        ]);
        payment_categories::create([
            'name'=>'Test Payment Category',
            'for'=>'Payment',
        ]);
    }
}

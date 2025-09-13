<?php

namespace Database\Seeders;

use App\Models\auctions;
use Illuminate\Database\Seeder;

class auctionSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => "Uss Yokohama"],
        ];
        auctions::insert($data);
    }
}

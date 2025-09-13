<?php

namespace Database\Seeders;

use App\Models\warehouses;
use App\Models\yards;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class yardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => "Gunma", 'address' => "898 Yawatabara-machi, Takasaki-shi, Gunma-ken 370-0024,Japan", 'contact' => "+81 273202306"],
            ['name' => "Fukuoka", 'address' => "3308-1 Yugeta,Tagawa-shi, Fukuoka-ken 826-0041,Japan", 'contact' => "+8107014550786"],
            ['name' => "Saitama", 'address' => "1454 Kamichujo, Kumagaya-shi, Saitama-ken 360-0001,Japan", 'contact' => "+8107014550786"],
        ];
        yards::insert($data);
    }
}

<?php

namespace Database\Seeders;

use App\Models\accounts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class accountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        accounts::create([
            'title' => "Bank",
            'type' => "Bank",
            'status' => "Active",
        ]);

        accounts::create([
            'title' => "Test Consignee",
            'type' => "Consignee",
            'address_one' => "Test Address",
            'address_two' => "Test Address",
            'license' => "Test License",
            'email' => "test@gmail.com",
            'tel' => "1234567890",
            'po_box' => "12345",
            'status' => "Active",
        ]);

        accounts::create([
            'title' => "Test Transporter",
            'type' => "Transporter",
            'status' => "Active",
        ]);

        
    }
}

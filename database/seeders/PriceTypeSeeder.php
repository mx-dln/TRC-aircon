<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PriceType;

class PriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $types = [
            ['code' => 'srp', 'label' => 'SRP'],
            ['code' => 'retail_discount', 'label' => 'Retail Discounted'],
            ['code' => 'dealer_silver', 'label' => 'Dealer Price (Silver) (Less than 100k)'],
            ['code' => 'dealer_gold', 'label' => 'Dealer Price (Gold) (100k–999k)'],
            ['code' => 'special_discount', 'label' => 'Special Discount (Total Sales of 1M+)'],
        ];

        foreach ($types as $type) {
            PriceType::create($type);
        }
    }
}

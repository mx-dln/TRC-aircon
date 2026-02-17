<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Supply & Installation',
                'description' => 'Complete supply and professional installation of all types of air conditioning systems for residential and commercial properties.',
                'color' => 'blue',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'General Cleaning',
                'description' => 'Thorough cleaning services to maintain optimal performance and air quality of your air conditioning units.',
                'color' => 'green',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Dismantling & Relocation',
                'description' => 'Professional dismantling and safe relocation services for your air conditioning units to new locations.',
                'color' => 'purple',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Repair & Maintenance',
                'description' => 'Comprehensive repair and maintenance services to keep your air conditioning systems running efficiently.',
                'color' => 'yellow',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Ducting Works',
                'description' => 'Expert installation and maintenance of ducting systems for efficient air distribution throughout your property.',
                'color' => 'red',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Design',
                'description' => 'Custom air conditioning system design services tailored to your specific requirements and space constraints.',
                'color' => 'indigo',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (static::getProductTypesAsArray() as $productType) {
            ProductType::create($productType);
        }
    }

    public function getProductTypesAsArray(): array
    {
        return [
            [
                'name' => [
                    'en' => 'Clothing',
                    'ar' => 'ألبسة',
                ]
            ],
            [
                'name' => [
                    'en' => 'accessories',
                    'ar' => 'إكسسوارات',
                ]
            ],
            [
                'name' => [
                    'en' => 'electronics',
                    'ar' => 'إلكترونيات'
                ]
            ],
            [
                'name' => [
                    'en' => 'furniture',
                    'ar' => 'أثاث',
                ]
            ],
            [
                'name' => [
                    'en' => 'Cosmetics',
                    'ar' => 'مستحضرات تجميلية',
                ]
            ]
        ];
    }
}

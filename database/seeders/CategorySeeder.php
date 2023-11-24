<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'type_id' => 1,
            'name' => 'Заработная плата'
        ]);
        Category::create([
            'type_id' => 1,
            'name' => 'Иные доходы'
        ]);

        Category::create([
            'type_id' => 2,
            'name' => 'Продукты питания'
        ]);
        Category::create([
            'type_id' => 2,
            'name' => 'Транспорт'
        ]);
        Category::create([
            'type_id' => 2,
            'name' => 'Мобильная связь'
        ]);
        Category::create([
            'type_id' => 2,
            'name' => 'Интернет',
        ]);
        Category::create([
            'type_id' => 2,
            'name' => 'Развлечения'
        ]);
        Category::create([
            'type_id' => 2,
            'name' => 'Другое'
        ]);
    }
}

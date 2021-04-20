<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

         $categories = $this->getCategories();

         foreach ($categories as $category) {
            Category::create($category);
         }

        \App\Models\Product::factory(10)->create();

    }

    private function getCategories()
    {
        return [
            ['name' => 'Produtos de Limpeza'],
            ['name' => 'Alimentacao'],
            ['name' => 'Eletrodomesticos'],
            ['name' => 'Higiene Pessoal'],
            ['name' => 'Pet'],
            ['name' => 'Encartelados'],
            ['name' => 'Automovel']
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        # Create parent categories
        $parentCategories = Category::factory(10)->create();

        # Create child categories with a parent
        $parentCategories->each(function ($parent) {
            Category::factory()
                ->count(5)
                ->withParent()
                ->create(['parent_id' => $parent->id]);
        });
    }
}

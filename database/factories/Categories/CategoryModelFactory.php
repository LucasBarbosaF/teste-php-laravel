<?php

namespace Database\Factories\Categories;

use App\Models\Categories\CategoryModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryModelFactory extends Factory
{
    protected $model = CategoryModel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
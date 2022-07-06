<?php

namespace Database\Factories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $id = 1;
        $name = $this->faker->name;
        return [
            'id' => $id++,
            'name' => $name,
            'slug' => Str::slug($name),
            'status' => '1',
            'created_at' => Carbon::now()->toTimeString(),
            'updated_at' => Carbon::now()->toTimeString(),
        ];
    }
}

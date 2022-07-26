<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
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
            'category_id' => 1,
            'user_id' => 1,
            'content' => 'this is content',
            'short_description' => 'short',
            'status' => config('custom.post_status.pending'),
            'created_at' => Carbon::now()->toTimeString(),
            'updated_at' => Carbon::now()->toTimeString(),
        ];
    }
}

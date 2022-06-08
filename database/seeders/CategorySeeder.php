<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::unguard();

        $categories = [
            [
                'name' => 'Travel',
                'slug' => Str::slug('Travel'),
                'status' => config('custom.category_status.show'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Fashion',
                'slug' => Str::slug('Fashion'),
                'status' => config('custom.category_status.show'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'Technology',
                'slug' => Str::slug('Technology'),
                'status' => config('custom.category_status.show'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
        ];
        Category::insert($categories);

        Category::reguard();
    }
}

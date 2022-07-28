<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Notification;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 3,
            'type' => 'App\Models\User',
            'notifiable_type' => 'App\Notifications\PostNotification',
            'notifiable_id' => 2,
            'data' => $this->faker->name,
            'read_at' => null,
            'created_at' => Carbon::now()->toTimeString(),
            'updated_at' => Carbon::now()->toTimeString(),
        ];
    }
}

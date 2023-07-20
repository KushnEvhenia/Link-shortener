<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Link::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'link' => $this->faker->text(255),
            'link_id' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

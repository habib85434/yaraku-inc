<?php

namespace Database\Factories;

use App\Models\AppKey;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppKeyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AppKey::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'app_name' => 'start up',
            'app_key' => '$dsFadsewad455AD5s5d8wret8v58f8esFF8$'
        ];
    }
}

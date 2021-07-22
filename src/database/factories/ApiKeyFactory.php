<?php

namespace Database\Factories;

use App\Models\ApiKey;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApiKeyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApiKey::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'api_key' => '$aslkjlkjALKJ1362A52AFd21a321D2F1df3213a21af321af5321D321ddaaETGHghsg2313ssdgd2542$'
        ];
    }
}


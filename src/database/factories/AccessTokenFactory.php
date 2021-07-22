<?php

namespace Database\Factories;

use App\Models\AccessToken;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AccessTokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccessToken::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'token' => '$lakjjafsK$AKA156adfa65d2af54DE36d2165DFAdfa65656358ADA55dDDdfaf$',
            'user_id' => $this->faker->numberBetween(1,20),
        ];
    }
}

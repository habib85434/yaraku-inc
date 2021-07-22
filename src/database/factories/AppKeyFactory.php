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
            'app_key' => '$a544AFD56654JHJH65465458233345asghfgsa5465ASF635dafdhhh45653llL85222dfasfd154555ASFDAFhabib$'
        ];
    }
}

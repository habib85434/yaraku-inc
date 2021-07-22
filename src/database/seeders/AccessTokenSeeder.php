<?php

namespace Database\Seeders;

use App\Models\AccessToken;
use Illuminate\Database\Seeder;

class AccessTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessToken::factory(1)->create();
    }
}

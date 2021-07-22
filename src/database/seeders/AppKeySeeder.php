<?php

namespace Database\Seeders;

use App\Models\AppKey;
use Illuminate\Database\Seeder;

class AppKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppKey::factory(1)->create();
    }
}

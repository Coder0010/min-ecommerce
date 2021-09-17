<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\User::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Merchant::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Product::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \App\Models\Product::factory(10)->create();
    }
}

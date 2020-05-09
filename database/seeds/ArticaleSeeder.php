<?php

use App\Articale;
use Illuminate\Database\Seeder;

class ArticaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Articale::class, 10)->create();
    }
}

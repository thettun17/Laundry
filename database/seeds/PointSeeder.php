<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Point;
class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Point::class,3)->create();
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Item;
class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Item::class, 10)->create();
    }
}

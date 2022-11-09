<?php

use Illuminate\Database\Seeder;
use App\ItemStatus;

class ItemStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['sl_no' => 1, 'item_status' => 'Active'],
            ['sl_no' => 4, 'item_status' => 'In-Active'],
            ['sl_no' => 3, 'item_status' => 'Test'],
            ['sl_no' => 2, 'item_status' => 'No-Answer'],
        ];

        ItemStatus::insert($data);
    }
}

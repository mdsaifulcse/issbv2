<?php

use Illuminate\Database\Seeder;
use App\ExamConfigStatus;

class ExamConfigStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['sl_no' => 0, 'status' => 'Upcoming'],
            ['sl_no' => 1, 'status' => 'Running'],
            ['sl_no' => 2, 'status' => 'Completed'],
            ['sl_no' => 3, 'status' => 'Cancel'],
            ['sl_no' => 4, 'status' => 'Pre-start'],
            ['sl_no' => 5, 'status' => 'Stop'],
        ];

        ExamConfigStatus::insert($data);
    }
}

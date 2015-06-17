<?php

use Illuminate\Database\Seeder;
use Knoters\Models\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusses = ['create'];

        foreach ($statusses as $status) {
            Status::create([
                'name' => $status
            ]);
        }
    }
}

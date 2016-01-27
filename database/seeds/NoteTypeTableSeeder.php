<?php

use Illuminate\Database\Seeder;
use Knoters\Models\NoteType;

class NoteTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $noteTypes = ['info', 'warning', 'error'];

        foreach ($noteTypes as $noteType) {
            NoteType::create([
                'type' => $noteType
            ]);
        }
    }
}

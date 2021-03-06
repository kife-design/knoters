<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('SourceTableSeeder');
        $this->call('StatusTableSeeder');
        $this->call('NoteTypeTableSeeder');
        //$this->call('UserTableSeeder');
        $this->call('ProjectTableSeeder');

        Model::reguard();
    }
}

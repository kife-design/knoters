<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Knoters\Models\Project::class, 5)->create()->each( function ($project) {
            for($i = 0; $i < 5; $i++) {
                $project->users()->save(factory(Knoters\Models\User::class)->make(), ['is_host' => ($i == 0 ? 1 : 0)]);
            }
        });
    }
}

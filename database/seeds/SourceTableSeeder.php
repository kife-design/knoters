<?php

use Illuminate\Database\Seeder;
use Knoters\Models\Source;

class SourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $audioSources = [];
        $videoSources = ['youtube', 'vimeo', 'dailymotion'];

        foreach ($audioSources as $audioSource) {
            Source::create([
                'name' => $audioSource,
                'type' => 'audio'
            ]);
        }

        foreach ($videoSources as $videoSource) {
            Source::create([
                'name' => $videoSource,
                'type' => 'video'
            ]);
        }
    }
}

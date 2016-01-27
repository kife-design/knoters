<?php

namespace Knoters\Transformers;


use Knoters\Models\Project;

class ProjectTransformer
{
    /**
     * Transform the resource to a new layout
     *
     * @param Project $project
     * @return array
     */
    public function transform(Project $project)
    {
        return [
            'token' => $project->uuid,
            'name' => $project->name,
            'status' => $project->status->name,
            'url' => $project->path,
            'source' => $project->source->name
        ];
    }
}

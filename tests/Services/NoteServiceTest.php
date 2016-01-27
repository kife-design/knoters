<?php

use Knoters\Models\Note;
use Knoters\Models\Project;
use Knoters\Models\User;
use Knoters\Repositories\NoteParameterRepository;
use Knoters\Repositories\NoteRepository;
use Knoters\Services\NoteService;
use Mockery as m;

class NoteServiceTest extends TestCase
{
    public function testGetByProject()
    {
        $noteService = $this->getNoteService($mocks = $this->getMocks());
        $project = factory(Project::class)->make();
        $user = factory(User::class)->make();

        $mocks['noteRepository']->shouldReceive('getByProjectId')->once()->andReturn(
            $this->getNotes($project->id, $user->id)
        );

        $notes = $noteService->getByProject($project);

        $this->assertCount(3, $notes);
    }

    public function testStore()
    {

    }

    public function testStoreParams()
    {

    }

    public function testUpdate()
    {

    }

    public function testDelete()
    {

    }

    private function getNoteService($mocks)
    {
        return new NoteService($mocks['noteRepository'], $mocks['noteParameterRepository']);
    }

    private function getMocks()
    {
        return [
            'noteRepository' => m::mock(NoteRepository::class),
            'noteParameterRepository' => m::mock(NoteParameterRepository::class)
        ];
    }

    private function getNotes($projectId, $userId)
    {
        return factory(Note::class, 3)
            ->make(['project_id' => $projectId, 'user_id' => $userId]);
    }
}

<?php

use Knoters\Services\Sources\ProjectPersister;
use Mockery as m;
use SKAgarwal\Reflection\ReflectableTrait;

class ProjectPersisterTest extends TestCase
{
    use ReflectableTrait;

    public function testPersist()
    {
        $this->expectsEvents(Knoters\Events\SourceWasCreated::class);

        $projectPersister = $this->getProjectPersister($mocks = $this->getMocks());

        $mocks['sourceRepository']->shouldReceive('pluckById')->once()->andReturn('youtube');
        $mocks['projectRepository']->shouldReceive('store')->once()->andReturn(factory('Knoters\Models\Project')->make());

        $mocks['userRepository']->shouldReceive('firstOrCreate')->times(3)->andReturn(factory('Knoters\Models\User')->make());
        $mocks['projectRepository']->shouldReceive('attachUser')->times(3)->andReturn(factory('Knoters\Models\User')->make());

        $response = $this->on($projectPersister)->call('persist', [$this->getParams()]);

        $this->assertEquals('ok', $response);
    }

    public function testStoreHost()
    {
        $projectPersister = $this->getProjectPersister($mocks = $this->getMocks());

        $mocks['userRepository']->shouldReceive('firstOrCreate')->once()->andReturn(factory('Knoters\Models\User')->make());
        $mocks['projectRepository']->shouldReceive('attachUser')->once()->andReturn(factory('Knoters\Models\User')->make());

        $this->on($projectPersister)->set('params', $params = $this->getParams());

        $response = $this->on($projectPersister)->call('storeHost', [factory('Knoters\Models\Project')->make()]);

        $this->assertEquals('ok', $response);
    }

    public function testStoreRecievers()
    {
        $projectPersister = $this->getProjectPersister($mocks = $this->getMocks());

        $mocks['userRepository']->shouldReceive('firstOrCreate')->twice()->andReturn(factory('Knoters\Models\User')->make());
        $mocks['projectRepository']->shouldReceive('attachUser')->twice()->andReturn(factory('Knoters\Models\User')->make());

        $this->on($projectPersister)->set('params', $params = $this->getParams());

        $response = $this->on($projectPersister)->call('storeReceivers', [factory('Knoters\Models\Project')->make()]);

        $this->assertEquals('ok', $response);
    }

    public function testStoreProject()
    {
        $projectPersister = $this->getProjectPersister($mocks = $this->getMocks());
        $mocks['sourceRepository']->shouldReceive('pluckById')->once()->andReturn('youtube');

        $this->on($projectPersister)->set('params', $params = $this->getParams());

        $mocks['projectRepository']->shouldReceive('store')->once()->andReturn(factory('Knoters\Models\Project')->make());

        $response = $this->on($projectPersister)->call('storeProject');

        $this->assertInstanceOf(\Knoters\Models\Project::class, $response);
    }

    public function testGetUser()
    {
        $projectPersister = $this->getProjectPersister($mocks = $this->getMocks());

        $mocks['userRepository']->shouldReceive('firstOrCreate')->once()->andReturn(factory('Knoters\Models\User')->make());

        $user = $this->on($projectPersister)->call('getUser', ['vincent@kifed.be']);

        $this->assertInstanceOf('\Knoters\Models\User', $user);
    }

    public function testGetReceivers()
    {
        $projectPersister = $this->getProjectPersister($mocks = $this->getMocks());

        $this->on($projectPersister)->set('params', $params = $this->getParams());

        $receivers = $this->on($projectPersister)->call('getReceivers');

        $this->assertEquals(2, count($receivers));

        $this->on($projectPersister)->set('params', $params = $this->getParams(';'));

        $receivers = $this->on($projectPersister)->call('getReceivers');

        $this->assertEquals(2, count($receivers));
    }

    public function testGetParam()
    {
        $projectPersister = $this->getProjectPersister($mocks = $this->getMocks());

        $this->on($projectPersister)->set('params', $params = $this->getParams());

        $response = $this->on($projectPersister)->call('getParam', ['source_id']);

        $this->assertEquals($response, $params['source_id']);
    }

    public function testSource()
    {
        $projectPersister = $this->getProjectPersister($mocks = $this->getMocks());

        $this->on($projectPersister)->set('params', $params = $this->getParams());

        $mocks['sourceRepository']->shouldReceive('pluckById')->once()->andReturn('youtube');

        $response = $this->on($projectPersister)->call('source');

        $this->assertInstanceOf(\Knoters\Services\Sources\YoutubeService::class, $response);
    }

    public function testGetSourceName()
    {
        $projectPersister = $this->getProjectPersister($mocks = $this->getMocks());

        $this->on($projectPersister)->set('params', $params = $this->getParams());

        $mocks['sourceRepository']->shouldReceive('pluckById')->once()->andReturn('youtube');

        $response = $this->on($projectPersister)->call('getSourceName');

        $this->assertEquals('youtube', $response);
    }

    public function getParams($delimeter = ',')
    {
        return [
            'email' => 'vincent@kifed.be',
            'source_id' => 1,
            'path' => 'https://www.youtube.com/watch?v=58T0iikn0NU',
            'receivers' => 'test1@test.com' . $delimeter . 'test2@test.com'
        ];
    }

    public function getProjectPersister($mocks)
    {
        return new ProjectPersister($mocks['projectRepository'],
            $mocks['userRepository'], $mocks['sourceRepository']);
    }

    public function getMocks()
    {
        return [
            'projectRepository' => m::mock('Knoters\Repositories\ProjectRepository'),
            'userRepository' => m::mock('Knoters\Repositories\UserRepository'),
            'sourceRepository' => m::mock('Knoters\Repositories\SourceRepository')
        ];
    }
}

<?php
namespace Knoters\Services\Sources;


use Exception;
use Knoters\Events\SourceWasCreated;
use Knoters\Models\Status;
use Knoters\Models\User;
use Knoters\Repositories\ProjectRepository;
use Knoters\Repositories\SourceRepository;
use Knoters\Repositories\UserRepository;
use Webpatser\Uuid\Uuid;

class ProjectPersister
{
    protected $params;

    /**
     * @var SourceRepository
     */
    private $sourceRepository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        ProjectRepository $projectRepository,
        UserRepository $userRepository,
        SourceRepository $sourceRepository
    )
    {
        $this->sourceRepository = $sourceRepository;
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * handle the storing of a new project
     *
     * @param $params
     * @return string
     */
    public function persist($params)
    {
        $this->params = $params;

        $project = $this->storeProject();

        $this->storeHost($project);
        $this->storeReceivers($project);

        event(new SourceWasCreated($project));

        return 'ok';
    }

    /**
     * Store the creater of the project to the database
     *
     * @param $project
     * @return string
     * @throws Exception
     */
    protected function storeHost($project)
    {
        $user = $this->getUser($this->getParam('email'));


        $this->projectRepository->attachUser($project->id, $user->id, User::IS_HOST);

        return 'ok';
    }

    /**
     * Store the participating users to the database
     *
     * @param $project
     * @return string
     */
    protected function storeReceivers($project)
    {
        foreach ($this->getReceivers() as $receiver) {
            $user = $this->getUser($receiver, User::IS_NOT_HOST);

            $this->projectRepository->attachUser($project->id, $user->id, User::IS_NOT_HOST);
        }

        return 'ok';
    }

    /**
     * Store the project to the database
     *
     * @return static
     * @throws Exception
     */
    protected function storeProject()
    {
        return $this->projectRepository->store([
            'uuid' => (string)Uuid::generate(4),
            'video_id' => $this->source()->getId($this->getParam('path')),
            'source_id' => $this->getParam('source_id'),
            'path' => $this->getParam('path'),
            'status_id' => Status::CREATE
        ]);
    }

    /**
     * get a user from an email
     *
     * @param $email
     * @return mixed
     */
    protected function getUser($email)
    {
        return $this->userRepository->firstOrCreate([
            'email' => $email,
        ]);
    }

    /**
     * get the receivers from a newly created project
     *
     * @return array
     * @throws Exception
     */
    public function getReceivers()
    {
        return explode(';', str_replace(',', ';', $this->getParam('receivers')));
    }

    /**
     * get a value from the params array that was passed
     *
     * @param $value
     * @return mixed
     * @throws Exception
     */
    public function getParam($value)
    {
        if (!isset($this->params[$value])) {
            throw new Exception('The parameter "' . $value . '" was not passed.');
        }

        return $this->params[$value];
    }

    /**
     * Create a class from a source
     *
     * @return mixed
     */
    protected function source()
    {
        return isset($this->source) ?
            $this->source : $this->source = app()->make('Knoters\Services\Sources\\' . ucfirst($this->getSourceName()) . 'Service');
    }

    /**
     * get the name from a provider source id
     *
     * @return mixed
     * @throws Exception
     */
    protected function getSourceName()
    {
        return $this->sourceRepository->pluckById($this->getParam('source_id'), 'name');
    }
}

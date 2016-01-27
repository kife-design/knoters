<?php

namespace Knoters\Http\Controllers;

use Exception;
use Illuminate\Contracts\Encryption\Encrypter;

use Knoters\Http\Requests;
use Knoters\Repositories\ProjectRepository;
use Knoters\Transformers\ProjectTransformer;
use Knoters\Transformers\UserTransformer;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;

class EditorController extends ApiController
{
    /**
     * @var UserRepository
     */
    private $projectRepository;

    /**
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        parent::__construct(new Manager);
        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Encrypter $encrypter
     * @param $hash
     * @return Response
     * @throws Exception
     */
    public function index(Encrypter $encrypter, $hash)
    {
        try {
            $params = $encrypter->decrypt($hash);

            $project = $this->projectRepository->find($params['project']);

            $user = $project->users->find($params['user']);

            if (is_null($user)) {
                throw new Exception('the user was not found');
            }

            $sourceClass = app()->make('Knoters\Services\Sources\\' . ucfirst($project->type->name) . 'Service');

            $video = $sourceClass->getVideo($project->video_id);

            $this->fractal->setSerializer(new ArraySerializer());

            JavaScriptFacade::put([
                'user' => $this->fractal->createData(new Item($user, new UserTransformer))->toArray(),
                'project' => $this->fractal->createData(new Item($project, new ProjectTransformer))->toArray()
            ]);

            return view('editor', ['video' => $video, 'project' => $project]);
        } catch (Exception $e) {
            throw $e;
            $this->errorResponse($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace Knoters\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Knoters\Http\Requests;
use Knoters\Repositories\ProjectRepository;
use Knoters\Services\NoteService;
use Knoters\Transformers\NoteTransformer;
use League\Fractal\Manager;

class NotesController extends ApiController
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var NoteService
     */
    private $noteService;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @param Request $request
     * @param ProjectRepository $projectRepository
     * @param NoteService $noteService
     */
    public function __construct(
        Request $request,
        ProjectRepository $projectRepository,
        NoteService $noteService
    ) {
        parent::__construct(new Manager);

        $this->request = $request;
        $this->noteService = $noteService;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $projectUuid
     * @return Response
     */
    public function index($projectUuid)
    {
        try {
            $project = $this->projectRepository->findByUuid($projectUuid, [], ['id']);

            if (is_null($project)) {
                return $this->errorNotFound(trans('exceptions.projectNotFound'));
            }

            $notes = $this->noteService->getByProject($project, ['replies']);

            return $this->respondWithCollection($notes, new NoteTransformer);
        } catch (Exception $e) {
            return $this->errorInternalError(trans('exceptions.errorWhileFetchingNotes'));
        }
    }

    /**
     * Display a listing of the resource, matching the passed search parameters.
     *
     * @param $projectUuid
     * @return \Illuminate\Support\Facades\Response
     * @throws Exception
     */
    public function search($projectUuid)
    {
        try {
            $project = $this->projectRepository->findByUuid($projectUuid, [], ['id']);

            if (is_null($project)) {
                return $this->errorNotFound(trans('exceptions.projectNotFound'));
            }

            $notes = $this->noteService->getByProjectAndSearch($project, $this->request->get('searchvalues'), ['replies']);

            return $this->respondWithCollection($notes, new NoteTransformer);
        } catch (Exception $e) {
            throw $e;
            return $this->errorInternalError(trans('exceptions.errorWhileFetchinNotes'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $projectToken
     * @return Response
     * @throws Exception
     */
    public function store($projectToken)
    {
        try {
            $this->request->merge(['projectToken' => $projectToken]);
            $note = $this->noteService->store($this->request->all());

            return $this->respondWithItem($note, new NoteTransformer);
        } catch (Exception $e) {
            throw $e;
            session(['exception' => trans('exceptions.errorWhileStoringNote')]);

            return $this->errorResponse($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $noteUuid
     * @return Response
     * @throws Exception
     */
    public function update($noteUuid)
    {
        try {
            $note = $this->noteService->update($noteUuid, $this->request->all());

            return $this->respondWithItem($note, new NoteTransformer);
        } catch (Exception $e) {
            throw $e;
            session(['exception' => trans('exceptions.errorWhileUpdatingNote')]);

            return $this->errorResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $projectUuid
     * @param $noteUuid
     * @return Response
     */
    public function destroy($noteUuid)
    {
        try {
            $this->noteService->delete($noteUuid);

            return new Response('OK');
        } catch (Exception $e) {
            session(['exception' => trans('exceptions.errorWhileDeletingNote')]);

            return $this->errorResponse($e);
        }
    }
}

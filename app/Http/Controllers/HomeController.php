<?php

namespace Knoters\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Knoters\Http\Requests;
use Knoters\Http\Requests\NewSourceRequest;
use Knoters\Repositories\SourceRepository;
use Knoters\Repositories\ProjectRepository;

class HomeController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @param SourceRepository $resourceRepository
     * @return Response
     * @throws Exception
     */
    public function index(SourceRepository $resourceRepository)
    {
        try {
            $resources = $resourceRepository->all()->groupBy('type');

            return view('home', compact('resources'));
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Submits the new source for processing
     *
     * @param NewSourceRequest $request
     * @param ProjectRepository $projectRepository
     * @throws Exception
     */
    public function submitSource(NewSourceRequest $request, ProjectRepository $projectRepository)
    {
        try {
            $projectRepository->store($this->request->except(['email', 'receivers']));
        } catch (Exception $e) {
            throw $e;
        }
    }
}

<?php

namespace Knoters\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Knoters\Http\Requests;
use Knoters\Http\Requests\NewSourceRequest;
use Knoters\Repositories\SourceRepository;
use Knoters\Repositories\UploadRepository;

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

        } catch (Exception $e) {
            throw $e;
        }
        $resources = $resourceRepository->all()->groupBy('type');

        return view('home', compact('resources'));
    }

    /**
     * Submits the new source for processing
     *
     * @param NewSourceRequest $request
     * @param UploadRepository $uploadRepository
     * @throws Exception
     */
    public function submitSource(NewSourceRequest $request, UploadRepository $uploadRepository)
    {
        try {
            $uploadRepository->store($this->request->except(['email', 'receivers']));
        } catch (Exception $e) {
            throw $e;
        }
    }
}

<?php
namespace Knoters\Http\Controllers;


use Illuminate\Http\Request;
use Knoters\Http\Requests\NewSourceRequest;
use Knoters\Services\Sources\ProjectPersister;

class SourceController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function store(NewSourceRequest $request, ProjectPersister $persister)
    {
        try {
            $persister->persist($this->request->all());
        } catch (Exception $e) {
            throw $e;
        }
    }
}

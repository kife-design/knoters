<?php
namespace Knoters\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Knoters\Http\Requests\NewSourceRequest;
use Knoters\Services\SourceHandler;

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

    public function store(NewSourceRequest $request, SourceHandler $handler)
    {
        try {
            $handler->handle($this->request->all());
        } catch (Exception $e) {
            throw $e;
        }
    }
}
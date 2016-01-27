<?php

namespace Knoters\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use Knoters\Http\Requests;
use Knoters\Services\ReplyService;
use Knoters\Transformers\ReplyTransformer;
use League\Fractal\Manager;

class RepliesController extends ApiController
{
    /**
     * @var ReplyService
     */
    private $replyService;
    /**
     * @var Request
     */
    private $request;

    /**
     * RepliesController constructor.
     * @param Request $request
     * @param ReplyService $replyService
     */
    public function __construct(Request $request,ReplyService $replyService)
    {
        parent::__construct(new Manager);
        $this->replyService = $replyService;
        $this->request = $request;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $noteUuid
     * @return Response
     * @throws Exception
     */
    public function store($noteUuid)
    {
        try {
            $this->request->merge(['noteUuid' => $noteUuid]);
            $reply = $this->replyService->store($this->request->all());

            return $this->respondWithItem($reply, new ReplyTransformer);
        } catch (Exception $e) {
            session(['exception' => trans('exceptions.errorWhileSavingReply')]);

            return $this->errorResponse($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $uuid
     * @return Response
     */
    public function update($uuid)
    {
        $reply = $this->replyService->update($uuid, $this->request->all());

        return $this->respondWithItem($reply, new ReplyTransformer);
    }
}

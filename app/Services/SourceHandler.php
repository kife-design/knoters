<?php
namespace Knoters\Services;


use Knoters\Models\Status;
use Knoters\Models\UploadEmail;
use Knoters\Repositories\SourceRepository;
use Knoters\Repositories\UploadEmailRepository;
use Knoters\Repositories\UploadRepository;

class SourceHandler
{
    protected $upload;
    /**
     * @var SourceRepository
     */
    private $sourceRepository;
    /**
     * @var UploadRepository
     */
    private $uploadRepository;
    /**
     * @var UploadEmailRepository
     */
    private $uploadEmailRepository;

    public function __construct(
        UploadRepository $uploadRepository,
        SourceRepository $sourceRepository,
        UploadEmailRepository $uploadEmailRepository
    ) {
        $this->sourceRepository = $sourceRepository;
        $this->uploadRepository = $uploadRepository;
        $this->uploadEmailRepository = $uploadEmailRepository;
    }

    public function handle($params)
    {
        $this->params = $params;

        $this->storeSource();
        $this->storeHost();
        $this->storeReceivers();
    }

    protected function storeHost()
    {
        $this->storeEmail($this->getParam('email'), UploadEmail::IS_HOST);
    }

    protected function storeReceivers()
    {
        $receivers = $this->getReceivers();
    }

    protected function storeSource()
    {
        $this->upload = $this->uploadRepository->store([
            'video_id'  => $this->source()->getId($this->getParam('path')),
            'source_id' => $this->getParam('source_id'),
            'path'      => $this->getParam('path'),
            'status_id' => Status::CREATE
        ]);
    }

    protected function storeEmail($email, $isHost)
    {
        $this->uploadEmailRepository->store([
            'upload_id' => $this->upload->id,
            'email'     => $email,
            'is_host'   => $isHost
        ]);
    }

    public function getReceivers()
    {
        $receivers = explode(';', str_replace(',', ';', $this->getParam('receivers')));

        foreach ($receivers as $receiver) {
            $this->storeEmail($receiver, UploadEmail::IS_NOT_HOST);
        }
    }

    public function getParam($value)
    {
        if (!isset($this->params[$value])) {
            throw new Exception('The parameter "' . $value . '" was not passed.');
        }

        return $this->params[$value];
    }

    protected function source()
    {
        return isset($this->source) ?
            $this->source : $this->source = app()->make('Knoters\Services\Sources\\' . ucfirst($this->getSourceName()));
    }

    protected function getSourceName()
    {
        return $this->sourceRepository->pluckById($this->getParam('source_id'), 'name');
    }
}
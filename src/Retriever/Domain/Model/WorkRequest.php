<?php
namespace Retriever\Domain\Model;

class WorkRequest
{
    private $document = '';

    public function __construct($document)
    {
        $this->document = $document;
    }

    public function withDocument(string $newDocument)
    {
        $newWorkRequest = clone $this;
        $newWorkRequest->document = $newDocument;

        return $newWorkRequest;
    }
}

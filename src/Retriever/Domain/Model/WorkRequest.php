<?php
namespace Retriever\Domain\Model;

class WorkRequest
{
    private $document = '';

    public function __construct($document, $destination)
    {
        $this->document = $document;
        $this->destination = $destination;
    }

    public function document()
    {
        return $this->document;
    }

    public function destination()
    {
        return $this->destination;
    }

    public function withDocument(string $newDocument)
    {
        $newWorkRequest = clone $this;
        $newWorkRequest->document = $newDocument;

        return $newWorkRequest;
    }

    public function withDestination(string $newDestination)
    {
        $newWorkRequest = clone $this;
        $newWorkRequest->destination = $newDestination;

        return $newWorkRequest;
    }
}

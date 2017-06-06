<?php
declare(strict_types=1);
namespace Retriever\Application;

class ScheduledRequest
{
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
}

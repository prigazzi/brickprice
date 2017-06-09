<?php
declare(strict_types=1);
namespace Retriever\Application;

class ScheduledRequest
{
    private $document;
    private $destination;
    private $scheduledOn;

    public function __construct(
        string $document,
        string $destination,
        string $scheduledOn
    ) {
        $this->document = $document;
        $this->destination = $destination;
        $this->scheduledOn = $scheduledOn;
    }

    public function document() : string
    {
        return $this->document;
    }

    public function destination() : string
    {
        return $this->destination;
    }

    public function scheduledOn() : string
    {
        return $this->scheduledOn;
    }
}

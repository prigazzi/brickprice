<?php
declare(strict_types=1);
namespace Retriever\Domain\Model;

class WorkRequest
{
    private $document;
    private $destination;
    private $requestedOn;

    public function __construct(
        string $document,
        string $destination,
        string $requestedOn = ''
    ) {
        $this->document = $document;
        $this->destination = $destination;
        $this->requestedOn = $this->validateDate($requestedOn);
    }

    public function document() : string
    {
        return $this->document;
    }

    public function destination() : string
    {
        return $this->destination;
    }

    public function requestedOn() : string
    {
        return $this->requestedOn->format(\DateTime::ATOM);
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

    private function validateDate(string $date)
    {
        if (empty($date)) {
            return new \DateTime();
        }

        $date = \DateTime::createFromFormat(
            \DateTime::ATOM,
            $date
        );

        if ($date === false) {
            throw new \InvalidArgumentException(
                'Invalid Date format, should be '.\DateTime::ATOM
            );
        }

        return $date;
    }
}

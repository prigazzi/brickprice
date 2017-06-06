<?php
declare(strict_types=1);
namespace Retriever\Application;

use Retriever\Domain\Model\WorkRequest;
use Retriever\Domain\Model\WorkRequestRepositoryInterface;

class Scheduler
{
    public function __construct(WorkRequestRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function scheduleRequest($document, $destination)
    {
        $workRequest = new WorkRequest($document, $destination);
        $this->repository->add($workRequest);

        return new ScheduledRequest(
            $workRequest->document(),
            $workRequest->destination()
        );
    }
}
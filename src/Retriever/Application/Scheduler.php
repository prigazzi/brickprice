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

    public function scheduleRequest(string $document, string $destination): ScheduledRequest
    {
        $workRequest = new WorkRequest($document, $destination);
        $this->repository->add($workRequest);

        return $this->convertRequestToScheduled($workRequest);
    }

    public function remainingRequestsExist()
    {
        return (bool)$this->repository->hasUnprocessedRequests();
    }

    public function retrieveScheduledRequest()
    {
        $workRequest = $this->repository->oldestRequest();

        if ($workRequest === null) {
            return null;
        }

        return $this->convertRequestToScheduled($workRequest);
    }

    public function acknowledgeRequest(ScheduledRequest $request)
    {
        $this->repository->acknowledgeWorkRequestByParams(
            $request->document(),
            $request->destination(),
            $request->scheduledOn()
        );
    }

    private function convertRequestToScheduled(WorkRequest $workRequest)
    {
        return new ScheduledRequest(
            $workRequest->document(),
            $workRequest->destination(),
            $workRequest->requestedOn()
        );
    }
}

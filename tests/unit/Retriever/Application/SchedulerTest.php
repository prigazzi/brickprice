<?php
namespace Retriever\Tests\Application;

use Retriever\Domain\Model\WorkRequestRepositoryInterface;
use Retriever\Domain\Model\WorkRequest;
use Retriever\Application\ScheduledRequest;
use Retriever\Application\Scheduler;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;


class SchedulerTest extends TestCase
{
    public function setUp()
    {
        $this->repository = $this->prophesize(WorkRequestRepositoryInterface::class);
        $this->scheduler = new Scheduler($this->repository->reveal());
    }

    public function test_a_new_ScheduledRequests_is_added()
    {
        $request = $this->prophesize(WorkRequest::class);

        $this->repository
            ->add(Argument::type(WorkRequest::class))
            ->willReturn($request->reveal());

        $result = $this->scheduler->scheduleRequest(
            'http://google.com',
            'google.html'
        );

        $this->assertInstanceOf(ScheduledRequest::class, $result);
    }
}

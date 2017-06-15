<?php
namespace Retriever\Tests\Domain\Model;

use Retriever\Domain\Model\WorkRequest;
use PHPUnit\Framework\TestCase;

class WorkRequestTest extends TestCase
{
    public function setUp()
    {
        $this->workRequest = new WorkRequest(
            'http://domain.com',
            'document-a.html'
        );
    }

    public function test_WorkRequest_is_immutable()
    {
        $newRequest1 = $this->workRequest->withDocument('http://domainb.com');
        $this->assertNotEquals($newRequest1, $this->workRequest);

        $newRequest2 = $this->workRequest->withDestination('document-b.html');
        $this->assertNotEquals($newRequest2, $this->workRequest);
        $this->assertNotEquals($newRequest1, $newRequest2);
    }

    public function test_that_an_exception_is_thrown_when_date_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        $workRequest = new WorkRequest(
                'http://google.com',
                'document.google.html',
                '20011005'
        );
    }

    public function test_a_valid_time_is_assigned_automatically()
    {
        $this->assertInstanceOf(
            \DateTime::class,
            \DateTime::createFromFormat(
                \DateTime::ATOM,
                $this->workRequest->requestedOn()
            )
        );
    }
}

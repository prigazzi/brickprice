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
}

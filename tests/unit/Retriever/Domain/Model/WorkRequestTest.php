<?php
namespace Retriever\Tests\Domain\Model;

use Retriever\Domain\Model\WorkRequest;
use PHPUnit\Framework\TestCase;

class WorkRequestTest extends TestCase
{
    public function setUp()
    {
        $this->workRequest = new WorkRequest('documenta.html');
    }

    public function test_WorkRequest_is_immutable()
    {
        $newRequest = $this->workRequest->withDocument('documentb.html');

        $this->assertNotEquals($newRequest, $this->workRequest);
    }
}

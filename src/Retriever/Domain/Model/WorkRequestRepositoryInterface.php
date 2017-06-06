<?php
declare(strict_types=1);
namespace Retriever\Domain\Model;

use Retriever\Domain\Model\WorkRequest;

interface WorkRequestRepositoryInterface
{
    public function add(WorkRequest $request) : WorkRequest;
}

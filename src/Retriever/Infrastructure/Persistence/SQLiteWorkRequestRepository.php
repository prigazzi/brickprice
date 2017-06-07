<?php
declare(strict_types=1);
namespace Retriever\Infrastructure\Persistence;

use Retriever\Domain\Model\WorkRequest;
use Retriever\Domain\Model\WorkRequestRepositoryInterface;

class SQLiteWorkRequestRepository implements WorkRequestRepositoryInterface
{
    public function __construct(string $databaseFile)
    {
        $this->database = new \Sqlite3($databaseFile);
        $this->createTable();
    }

    public function add(WorkRequest $request) : WorkRequest
    {
        $this->database->exec("
          INSERT INTO RETRIEVER_WORKREQUEST
          (workrequest_document, workrequest_destination)
          VALUES
          ('{$request->document()}', '{$request->destination()}')
        ");

        return $request;
    }

    private function createTable()
    {
        $isValid = $this->database->exec("
            CREATE TABLE IF NOT EXISTS RETRIEVER_WORKREQUEST (
                workrequest_id INTEGER PRIMARY KEY AUTOINCREMENT,
                workrequest_document VARCHAR(255) NOT NULL,
                workrequest_destination VARCHAR(255) NOT NULL
            )
        ");

        if (!$isValid) {
            throw new \RuntimeException(
                    "Couldn't create table RETRIEVER_WORKREQUEST"
            );
        }
    }

}

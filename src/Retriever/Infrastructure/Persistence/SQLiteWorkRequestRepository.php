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
          (workrequest_document, workrequest_destination, workrequest_requestedOn)
          VALUES
          ('{$request->document()}', '{$request->destination()}', '{$request->requestedOn()}')
        ");

        return $request;
    }

    public function has()
    {
        $result = $this->database->query("
            SELECT COUNT(workrequest_id) as total
            FROM RETRIEVER_WORKREQUEST
        ");

        if ($result->numColumns() === 0 && $result->columnType(0) === SQLITE3_NULL) {
            return null;
        }

        $amount = $result->fetchArray();

        return $amount['total'];
    }

    private function createTable()
    {
        $isValid = $this->database->exec("
            CREATE TABLE IF NOT EXISTS RETRIEVER_WORKREQUEST (
                workrequest_id INTEGER PRIMARY KEY AUTOINCREMENT,
                workrequest_document VARCHAR(255) NOT NULL,
                workrequest_destination VARCHAR(255) NOT NULL,
                workrequest_requestedOn CHAR(25),
                workrequest_processedOn CHAR(25)
            )
        ");

        if (!$isValid) {
            throw new \RuntimeException(
                    "Couldn't create table RETRIEVER_WORKREQUEST"
            );
        }
    }

}

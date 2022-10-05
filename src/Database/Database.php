<?php declare(strict_types=1);

namespace MouradA\Blog\Database;


class Database
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(
            $this->getConnectionLink(),
            $_ENV['MYSQL_USER'],
            $_ENV['MYSQL_PASSWORD'],
            [\PDO::ATTR_PERSISTENT => true]
        );
    }

    private function getConnectionLink(): string
    {
        return "mysql:host=mysql;dbname={$_ENV['MYSQL_DATABASE']}";
    }


    public function selectFromTable(string $table, array $where = [], array $orderBy = [], int $limit = 0, int $offset = 0): array
    {
        $query = $this->buildSelectQuery($table, $where, $orderBy, $limit, $offset);
        $statement = $this->pdo->prepare($query);
        $this->bindSelectValues($statement, $where, $orderBy, $limit, $offset);

        $this->executeStatement($statement);
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    private function buildSelectQuery(string $table, array $where = [], array $orderBy = [], int $limit = 0, int $offset = 0): string
    {
        $query = "SELECT * FROM `{$table}`";
        if ($where !== []) {
            $wherePlaceholders = [];
            foreach ($where as $key => $value) {
                $wherePlaceholders[] = "{$key} = :{$key}";
            }
            $query .= " WHERE " . implode(' AND ', $wherePlaceholders);
        }
        if ($orderBy !== []) {
            $query .= " ORDER BY :orderBy";
        }
        if ($limit > 0) {
            $query .= " LIMIT :limit";
        }
        if ($offset > 0) {
            $query .= " OFFSET :offset";
        }
        return $query;
    }

    private function bindSelectValues(\PDOStatement $statement, array $where, array $orderBy, int $limit, int $offset): void
    {
        if ($where !== []) {
            foreach ($where as $key => $value) {
                $statement->bindValue(":{$key}", $value);
            }
        }
        if ($orderBy !== []) {
            $statement->bindValue(':orderBy', implode(',', $orderBy));
        }
        if ($limit > 0) {
            $statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        }
        if ($offset > 0) {
            $statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        }
    }

    private function buildSelectBindings(
        string $table,
        array $where = [],
        array $orderBy = [],
        int $limit = 0,
        int $offset = 0
    ): array
    {
        $bindings = [$table];
        if ($where !== []) {
            foreach ($where as $key => $value) {
                $bindings[] = $key;
                $bindings[] = $value;
            }
        }
        if ($orderBy !== []) {
            $bindings = array_merge($bindings, $orderBy);
        }
        if ($limit > 0) {
            $bindings[] = $limit;
        }
        if ($offset > 0) {
            $bindings[] = $offset;
        }
        return $bindings;
    }

    public function insertIntoTable(string $table, array $data): bool
    {
        $query = $this->buildInsertQuery($data);
        $bindings = $this->buildInsertBindings($table, $data);

        $statement = $this->pdo->prepare($query);
        return $this->executeStatement($statement, $bindings);
    }

    private function buildInsertQuery(array $data): string
    {
        $dataPlaceholders = array_fill(0, count($data), '?');
        return "INSERT INTO `?` VALUES (" . implode(', ', $dataPlaceholders) . ')';
    }

    private function buildInsertBindings(string $table, array $data): array
    {
        return array_merge([$table], $data);
    }

    public function updateTable(string $table, array $data, array $where = []): int
    {
        $query = $this->buildUpdateQuery($data, $where);
        $bindings = $this->buildUpdateBindings($table, $data, $where);

        $statement = $this->pdo->prepare($query);
        $this->executeStatement($statement, $bindings);
        return $statement->rowCount();
    }

    private function buildUpdateQuery(array $data, array $where): string
    {
        $dataPlaceholders = array_fill(0, count($data), '? = ?');
        $wherePlaceholders = array_fill(0, count($where), '? = ?');
        return "UPDATE `?` SET " . implode(', ', $dataPlaceholders) . " WHERE " . implode(' AND ', $wherePlaceholders);
    }

    private function buildUpdateBindings(string $table, array $data, array $where): array
    {
        $bindings = [$table];

        foreach ($data as $key => $value) {
            $bindings[] = $key;
            $bindings[] = $value;
        }

        foreach ($where as $key => $value) {
            $bindings[] = $key;
            $bindings[] = $value;
        }

        return $bindings;
    }

    public function deleteFromTable(string $table, array $where = []): int
    {
        $query = $this->buildDeleteQuery($where);
        $bindings = $this->buildDeleteBindings($table, $where);

        $statement = $this->pdo->prepare($query);
        $this->executeStatement($statement, $bindings);
        return $statement->rowCount();
    }

    private function buildDeleteQuery(array $where): string
    {
        $wherePlaceholders = array_fill(0, count($where), '? = ?');
        return "DELETE FROM `?` WHERE " . implode(' AND ', $wherePlaceholders);
    }

    private function buildDeleteBindings(string $table, array $where): array
    {
        $bindings = [$table];
        foreach ($where as $key => $value) {
            $bindings[] = $key;
            $bindings[] = $value;
        }
        return $bindings;
    }

    public function getRowCount(string $table): int
    {
        $statement = $this->pdo->prepare("SELECT COUNT(*) as `count` FROM `?`");
        $this->executeStatement($statement, [$table]);
        return (int)$statement->fetchColumn();
    }

    private function executeStatement(\PDOStatement $statement, ?array $bindings = null): bool
    {
        try {
            return $statement->execute($bindings);
        } catch (\PDOException $exception) {
            throw new \Exception($exception->getMessage(), (int)$exception->getCode());
        }
    }
}
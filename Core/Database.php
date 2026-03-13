<?php

namespace Luna\Core;

use Core\Contracts\DatabaseInterface;

class Database implements DatabaseInterface
{
    private ?\PDO $pdo = null;

    public function __construct(
        private array $config
    ) {
    }

    public function connect(): void
    {
        if ($this->pdo !== null) {
            return;
        }

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            $this->config['host'],
            $this->config['port'],
            $this->config['dbname'],
            $this->config['charset']
        );

        $this->pdo = new \PDO(
            $dsn,
            $this->config['username'],
            $this->config['password'],
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]
        );
    }

    public function query(string $sql, array $params = []): mixed
    {
        $this->connect();

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    public function fetch(string $sql, array $params = []): array|false
    {
        return $this->query($sql, $params)->fetch();
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function pdo(): \PDO
    {
        $this->connect();

        return $this->pdo;
    }
}

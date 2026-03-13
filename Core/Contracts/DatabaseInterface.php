<?php

namespace Luna\Core\Contracts;

interface DatabaseInterface
{
    public function connect(): void;

    public function query(string $sql, array $params = []): mixed;

    public function fetch(string $sql, array $params = []): array|false;

    public function fetchAll(string $sql, array $params = []): array;
}

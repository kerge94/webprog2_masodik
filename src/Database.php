<?php

final class Database
{
    private mysqli $connection;

    public function __construct(
        string $hostname,
        string $username,
        string $password,
        string $database
    ) {
        $this->connection = new mysqli($hostname, $username, $password, $database);

        if ($error = $this->connection->connect_error) {
            die("Database connection failed: $error");
        }
    }

    public function __destruct()
    {
        $this->connection->close();
    }    

    public function query(string $query, string $types, array $params)
    {
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }
}

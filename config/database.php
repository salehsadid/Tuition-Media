<?php

define('DB_HOST', 'localhost');
define('DB_PORT', '1521');
define('DB_SID', 'XE');
define('DB_USER', 'smarttutor');
define('DB_PASS', 'smarttutor123');
define('DB_CHARSET', 'AL32UTF8');

define('DB_DSN', DB_HOST . ':' . DB_PORT . '/' . DB_SID);

class Database
{
    private static ?Database $instance = null;
    private $connection;

    private function __construct()
    {
        $this->connection = oci_connect(DB_USER, DB_PASS, DB_DSN, DB_CHARSET);

        if (!$this->connection) {
            die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function fetchAll(string $sql, array $binds = []): array
    {
        $stmt = $this->prepare($sql, $binds);
        oci_execute($stmt, OCI_DEFAULT);

        $rows = [];
        while ($row = oci_fetch_assoc($stmt)) {
            $rows[] = array_change_key_case($row, CASE_LOWER);
        }

        oci_free_statement($stmt);
        return $rows;
    }

    public function fetchOne(string $sql, array $binds = []): ?array
    {
        $stmt = $this->prepare($sql, $binds);
        oci_execute($stmt, OCI_DEFAULT);

        $row = oci_fetch_assoc($stmt);
        oci_free_statement($stmt);

        return $row ? array_change_key_case($row, CASE_LOWER) : null;
    }

    public function execute(string $sql, array $binds = []): bool
    {
        $stmt = $this->prepare($sql, $binds);
        $result = oci_execute($stmt, OCI_DEFAULT);
        oci_free_statement($stmt);
        return (bool) $result;
    }


    private function prepare(string $sql, array $binds)
    {
        $stmt = oci_parse($this->connection, $sql);

        if (!$stmt) {
            throw new RuntimeException('SQL parse error');
        }

        foreach ($binds as $placeholder => $value) {
            $key = (str_starts_with($placeholder, ':')) ? $placeholder : ':' . $placeholder;
            oci_bind_by_name($stmt, $key, $binds[$placeholder]);
        }

        return $stmt;
    }

}

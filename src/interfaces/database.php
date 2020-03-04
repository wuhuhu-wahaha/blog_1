<?php

namespace Blog\Interfaces;

interface database
{
    public function __construct(string $servername, string $username, string $password, string $dbname);

    public function query(string $query);

    public function fetch_assoc(string $query);

    public function fetch_all(string $query);

    public function insert_id();

    public function esc(String $value);

}
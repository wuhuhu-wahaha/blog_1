<?php
declare(strict_types=1);

namespace Blog\Classes;

use Blog\Interfaces\database;
use mysqli;
use mysqli_result;


class mysql implements database
{
    /**
     * @var null | mysqli
     */
    protected $db = null;

    /**
     * Constructor.
     *
     * @param string $servername
     * @param string $username
     * @param string $password
     * @param string $dbname
     */
    public function __construct(string $servername, string $username, string $password, string $dbname) {
        $this->db = new mysqli($servername, $username, $password, $dbname);

    }

    /**
     * @param string $query
     *
     * @return bool|mysqli_result
     */
    public function query(string $query) {
        return mysqli_query( $this->db, $query);
    }

    /**
     * @param string $query
     *
     * @return array
     */
    public function fetch_assoc(string $query) : ?array {
        return mysqli_fetch_assoc( mysqli_query( $this->db, $query));
    }

    /**
     * Returns result set of query.
     *
     * @param string $query
     * @return array
     */
    public function fetch_all(string $query) : ?array {

        $result = $this->query($query);

        if (is_null($result)) {
            return [];
        }

        return mysqli_fetch_all($result,MYSQLI_ASSOC);

    }

    /**
     * @return string
     */
    public function insert_id() {
        return mysqli_insert_id($this->db);
    }

    /**
     * @param String $value
     *
     * @return string
     * Escapes form submitted value, hence, preventing SQL injection
     */
    public function esc(string $value) : string{
        return mysqli_real_escape_string( $this->db, trim($value));
    }

}
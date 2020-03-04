<?php
declare(strict_types=1);

namespace Blog\Classes;
use interfaces\Database;
use mysqli_result;

/**
 * Class blog
 *
 * @package Blog\Classes
 */
class blog
{
    private $database = null;

    /**
     * blog constructor.
     *
     * @param Database $db
     */
    public function __construct(database $db) {
        $this->database = $db;
    }

    /**
     * Returns blog list as array.
     *
     * @return mysqli_result
     */
    public function getBlogList():mysqli_result{

        return $this->database->query('SELECT * FROM users ORDER BY id DESC');

    }
}

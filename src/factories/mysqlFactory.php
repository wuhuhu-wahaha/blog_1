<?php
namespace Blog\Factories;

use  Blog\Classes\mysql;

/**
 * Class mysqlFactory
 *
 * @package Blog\Factories
 */
class mysqlFactory
{
    private const SERVERNAME = 'localhost';
    private const USERNAME = 'root';
    private const PASSWORD = '';
    private const DBNAME = 'blog';

    static function getMySqlInstance():mysql {
        return new mysql(static::SERVERNAME, static::USERNAME, static::PASSWORD, static::DBNAME);
    }

}
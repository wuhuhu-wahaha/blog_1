<?php
namespace Blog\Factories;

use  Blog\Classes\user;
use  Blog\Factories\mysqlFactory;

/**
 * Class userFactory
 * Factory for userClass
 *
 * @package factories
 */
class userFactory
{
    /**
     * Returns user instance.
     *
     * @return user
     */
    static function getUserInstance(): user {

        $mySql = mysqlFactory::getMySqlInstance();
        return new user($mySql);

    }

}
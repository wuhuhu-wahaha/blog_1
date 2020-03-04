<?php
namespace Blog\Factories;

use Blog\Factories\mysqlFactory;
use Blog\Classes\blog;

class blogFactory
{
    static function getUserInstance() {

        $mySql = mysqlFactory::getMySqlInstance();
        return new blog($mySql);

    }

}
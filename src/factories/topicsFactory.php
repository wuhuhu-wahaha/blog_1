<?php
namespace Blog\Factories;

use Blog\Classes\topics;
use Blog\Factories\mysqlFactory;


class topicsFactory
{
    static function getTopicsInstance() {

        $mySql = mysqlFactory::getMySqlInstance();
        return new topics($mySql);

    }

}
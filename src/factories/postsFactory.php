<?php
namespace Blog\Factories;

use Blog\Classes\posts;
use Blog\Factories\mysqlFactory;

class postsFactory
{
    static function getPostsInstance() {

        $mySql = mysqlFactory::getMySqlInstance();
        return new posts($mySql);

    }
}
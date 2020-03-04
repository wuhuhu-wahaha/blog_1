<?php
declare(strict_types=1);

namespace Blog\Classes;


class helperClass
{
    public static function makeSlug(String $string) : string {
        $string = strtolower($string);
        return preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    }
}
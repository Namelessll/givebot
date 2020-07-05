<?php


namespace App\Classes\Bot\Competitions;


class Competition
{
    protected static $_instance;

    private function __construct() {
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    private function __clone() {
    }

    private function __wakeup() {
    }

    private static function cutInviteId($text) {
        $rsMessage = explode(' ', $text);
        if (isset($rsMessage[1]))
            return $rsMessage[1];
        else
            return 0;
    }

}

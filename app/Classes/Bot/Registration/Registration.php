<?php


namespace App\Classes\Bot\Registration;


use App\Models\Bot\BotUsersModel;

class Registration
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

    public function registerUserIfNoExist($text, $userId, $userName, $userFirstName = "") {
        return BotUsersModel::registerUserIfNoExist($userId, self::cutInviteId($text), $userName, $userFirstName);
    }


}

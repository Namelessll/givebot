<?php


namespace App\Classes\Bot\Buttons;


class Buttons
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

    public function returnMainMenuButtons() {
        return [
            ['⚠ Информация о розогрыше', '🔎 Проверить мое участие'],
            ['Правила'],
        ];
    }
}

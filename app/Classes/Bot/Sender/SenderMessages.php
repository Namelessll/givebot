<?php

namespace App\Classes\Bot\Sender;

use App\Classes\Bot\Buttons\Buttons;
use App\Classes\Bot\Registration;
use Telegram;
use Telegram\Bot\Keyboard\Keyboard;

class SenderMessages
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

    public function startBot($text, $userId, $userName, $userFirstName) {
        if (mb_stristr($text, '/start')) {
            $response = Registration\Registration::getInstance()->registerUserIfNoExist($text, $userId, $userName, $userFirstName);

            $reply_markup = Keyboard::make([
                'keyboard' => Buttons::getInstance()->returnMainMenuButtons(),
                'resize_keyboard' => true,
            ]);

            if ($response)
                Telegram::sendMessage([
                    'chat_id' => $userId,
                    'text' => "Вы успешно зарегистрированы!",
                    'parse_mode' => 'HTML',
                    'reply_markup' => $reply_markup
                ]);
            else
                Telegram::sendMessage([
                    'chat_id' => $userId,
                    'text' => "Главное меню",
                    'parse_mode' => 'HTML',
                    'reply_markup' => $reply_markup
                ]);
        }
    }

}

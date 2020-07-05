<?php

namespace App\Classes\Bot\Sender;

use App\Classes\Bot\Buttons\Buttons;
use App\Classes\Bot\Registration;
use App\Classes\Cron\CronModel\CronModel;
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
            if (isset(explode(' ', $text)[1]))
                Telegram::sendMessage([
                    'chat_id' => explode(' ', $text)[1],
                    'text' => "Ваш шанс выигрыша увеличен на 0.1%",
                    'parse_mode' => 'HTML',
                ]);

            $response = Registration\Registration::getInstance()->registerUserIfNoExist($text, $userId, $userName, $userFirstName);

            $reply_markup = Keyboard::make([
                'keyboard' => Buttons::getInstance()->returnMainMenuButtons(),
                'resize_keyboard' => true,
            ]);

            if ($response)
                Telegram::sendMessage([
                    'chat_id' => $userId,
                    'text' => "Вы успешно зарегистрированы в конкурсе!🥳\nПозавершению розыгрыша будет объявлен победитель!\nЕсли им окажитесь вы, бот пришлет вам уведомление 🛎",
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
            die();
        }
    }

    public function getInfoAboutCompetition($text, $userId) {
        if ($text == '⚠ Информация о розогрыше') {
            $competition = CronModel::getProcessCompetition();
            if (!empty($competition) && count($competition) > 0)
                $competition = $competition[0];
            else {
                Telegram::sendMessage([
                    'chat_id' => $userId,
                    'text' => '⚠ Активных розыгрышей сейчас нет'
                ]);
                die();
            }
            $str = '';
            if ($competition->users_count)
                $str = "\n\nКоличество участников: " .CronModel::getUsersCountForCompetition($competition->id);

            Telegram::sendMessage([
               'chat_id' => $userId,
               'text' => $competition->post_content . $str,
                'parse_mode' => 'HTML'
            ]);

        }
    }

    public function getRules($text, $userId) {
        if ($text == 'Правила') {
            Telegram::sendMessage([
                'chat_id' => $userId,
                'text' => 'Главное правило, никаких правил нет :)',
                'parse_mode' => 'HTML'
            ]);
        }
    }

    public function checkMyMember($text, $userId) {
        if ($text == '🔎 Проверить мое участие') {
            $competition = CronModel::getProcessCompetition();
            if (count($competition) < 1) {
                Telegram::sendMessage([
                    'chat_id' => $userId,
                    'text' => '⚠ Активных розыгрышей сейчас нет'
                ]);
                die();
            }

            $subscribeChannels = unserialize($competition[0]->subscribe_channels);

            $check = true;
            foreach ($subscribeChannels as $channel) {
                $responseChannelData = Telegram::getChatMember([
                    'chat_id' => $channel,
                    'user_id' => $userId
                ]);

                if ($responseChannelData->status == 'left')
                    $check = false;
            }

            if ($check === false) {
                $getNeedChannels = unserialize($competition[0]->subscribe_channels);

                $str = "\n\nПроверьте подписку на следующие каналы:\n";
                foreach ($getNeedChannels as $channel) {

                    $responseChannelData = Telegram::getChatMember([
                        'chat_id' => $channel,
                        'user_id' => $userId
                    ]);
                    if ($responseChannelData->status == 'left')
                        $str .= "\n".$channel;
                }

                Telegram::sendMessage([
                    'chat_id' => $userId,
                    'text' => '⚠ Вы не выполнили все условия розыгрыша, убедитесь что вы подписаны на все каналы указанные в описании..' . $str
                ]);
                CronModel::removeUserIfHerExist($competition[0]->id, $userId);
                die();
            }

            if ($check) {
                $idsUser = CronModel::addUserToCompetition($competition[0]->id, $userId);
                if ($idsUser) {
                    Telegram::sendMessage([
                        'chat_id' => $userId,
                        'text' => '✅ Вы выполнили все условия розыгрыша. Ваш идентивикатор: ' . $idsUser
                    ]);
                } else {
                    Telegram::sendMessage([
                        'chat_id' => $userId,
                        'text' => '⛔ Вы уже являетесь участником конкурса.'
                    ]);
                }
            }
        }
    }

    public function getFriendMess($text, $userId) {
        if ($text == '👬 Пригласить друга') {
            $botName = Telegram::getMe()['username'];
            Telegram::sendMessage([
                'chat_id' => $userId,
                'text' => "🎁 Пригласите друга и получите дополнительный шанс выигрыша.\n\nhttps://t.me/".$botName."?start=".$userId
            ]);
        }
    }

}

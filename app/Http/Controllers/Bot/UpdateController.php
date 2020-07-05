<?php

namespace App\Http\Controllers\Bot;

use App\Classes\Bot\Sender\SenderMessages;
use App\Classes\Cron\CronModel\CronModel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Telegram;

class UpdateController extends Controller
{
    protected static $messageText;
    protected static $userId;
    protected static $username;
    protected static $userFirstName;

    private static function keepRequest($request) {
        self::$messageText = $request['message']['text'];
        self::$userId = $request['message']['chat']['id'];
        self::$username = $request['message']['chat']['username'];
        self::$userFirstName =  $request['message']['chat']['first_name'];
    }

    public function getWebhookUpdates(Request $request) {
        if (isset($request['message']['text']))
            self::keepRequest($request);

        try {
            if (!isset(self::$username)) {
                Telegram::sendMessage([
                    'chat_id' => self::$userId,
                    'text' => "⚠ Для участия в розыгрышах, вам обязательно необходим @username",
                    'parse_mode' => 'HTML',
                ]);
                die();
            }
            SenderMessages::getInstance()->startBot(self::$messageText, self::$userId, self::$username, self::$userFirstName);
            SenderMessages::getInstance()->getInfoAboutCompetition(self::$messageText, self::$userId);
            SenderMessages::getInstance()->checkMyMember(self::$messageText, self::$userId);
            SenderMessages::getInstance()->getRules(self::$messageText, self::$userId);
            SenderMessages::getInstance()->getFriendMess(self::$messageText, self::$userId);
        } catch (\Throwable $e) {
            Telegram::sendMessage([
                'chat_id' => 509940535,
                'text' => $e->getMessage() . PHP_EOL,
                'parse_mode' => 'HTML',
            ]);
        }
    }
}

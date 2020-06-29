<?php


namespace App\Classes\Cron;

use App\Classes\Cron\CronModel\CronModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Telegram;

class CronFunctions
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

    private function getButtonToBot() {
        return [
            [
                ['text' => '🔥 Участвовать 🔥', 'url' => 'https://t.me/testing_givebot']
            ]
        ];
    }

    public function startCompetitions() {
        $competition = CronModel::getUnProcessCompetition();

        if (count($competition) > 0)
            $competition = $competition[0];
        else
            return;

        if (!Carbon::parse($competition->post_start) > Carbon::now()->setTimezone('Europe/Moscow'))
            return;

        $keyboard = array("inline_keyboard"=> array_values($this->getButtonToBot()), 'one_time_keyboard' => true);
        $keyboard = json_encode($keyboard);

        $postChannels = unserialize($competition->post_channels);
        foreach ($postChannels as $channel) {
            Telegram::sendMessage([
                'chat_id' => $channel,
                'text' => $competition->post_content,
                'parse_mode' => 'HTML',
            ]);
            Telegram::sendMessage([
                'chat_id' => $channel,
                'text' => "👇 <b>Жми на кнопку!</b>",
                'parse_mode' => 'HTML',
                'reply_markup' => $keyboard
            ]);
        }
        CronModel::updateCompetition($competition->id);
    }

}

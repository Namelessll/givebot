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
        try {
            $competition = CronModel::getUnProcessCompetition();

            if (count($competition) > 0)
                $competition = $competition[0];
            else
                return;

            if (Carbon::parse($competition->post_start) > Carbon::now()->addHours(3))
                return;

            $keyboard = array("inline_keyboard"=> array_values($this->getButtonToBot()), 'one_time_keyboard' => true);
            $keyboard = json_encode($keyboard);

            $postChannels = unserialize($competition->post_channels);
            foreach ($postChannels as $channel) {
                $str = '';
                if ($competition->users_count)
                    $str = "\n\nКоличество участников: " .CronModel::getUsersCountForCompetition($competition->id);

                Telegram::sendMessage([
                    'chat_id' => $channel,
                    'text' => $competition->post_content . $str,
                    'parse_mode' => 'HTML',
                ]);
                Telegram::sendMessage([
                    'chat_id' => $channel,
                    'text' => "👇 <b>Жми на кнопку!</b>",
                    'parse_mode' => 'HTML',
                    'reply_markup' => $keyboard
                ]);
            }
            CronModel::updateCompetition($competition->id, 1);
        } catch (\Throwable $e) {
            Telegram::sendMessage([
                'chat_id' => 509940535,
                'text' => $e->getMessage() . PHP_EOL,
                'parse_mode' => 'HTML',
            ]);
        }
    }

    public function endCompetitions() {
        $competition = CronModel::getProcessCompetition();

        if (count($competition) > 0)
            $competition = $competition[0];
        else
            return;

        if (Carbon::parse($competition->post_end) > Carbon::now()->addHours(3))
            return;

        try {
            $usersCompetition = CronModel::getUsersForCompetition($competition->id);
            $usersCompetition = json_decode($usersCompetition);
            $usersKeys = array();
            foreach ($usersCompetition as $key => $competitionItem)
                $usersKeys[] = $key;

            if (count($usersCompetition) >= $competition->winners_count)
                $winners = array_rand($usersKeys, $competition->winners_count);
            else
                $winners = array_rand($usersKeys, count($usersCompetition));

            if (isset($winners))
                if(!is_array($winners))
                    $winners = [
                        $winners
                    ];

            foreach ($winners as $winner)
                $winnersAr[] = $usersCompetition[$winner];

            if (!isset($winnersAr))
                return;

            $winnersStr = "";
            if (count($winnersAr) > 1) {
                foreach ($winnersAr as $item)
                    $winnersStr .= "\n@". CronModel::getUserInfo($item->user_id_link)[0]->username;
            } else
                $winnersStr .= "\n@". CronModel::getUserInfo($winnersAr[0]->user_id_link)[0]->username;

            foreach (unserialize($competition->post_channels) as $channel)
                Telegram::sendMessage([
                    'chat_id' => $channel,
                    'text' => "Определился победитель!🥳 \n " . $winnersStr . "\n\nС вами свяжется администратор для вречения приза.🎁\n\nУ всех остальных участников конкурса еще раз испытать свою удачу в следующем конкурсе.",
                    'parse_mode' => 'HTML',
                ]);

            CronModel::updateCompetition($competition->id, 2);


        } catch (\Throwable $e) {
            Telegram::sendMessage([
                'chat_id' => 509940535,
                'text' => $e->getMessage() . PHP_EOL,
                'parse_mode' => 'HTML',
            ]);
        }
    }


}

<?php

namespace App\Models\Dashboard;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServicesModel extends Model
{
    public function setSetting($code, $val) {
        if (DB::table('table_server_settings')->where('setting_code', $code)->doesntExist()) {
            return DB::table('table_server_settings')
                ->insert([
                    'setting_code' => $code,
                    'setting_value' => $val
                ]);
        } else {
            return DB::table('table_server_settings')
                ->where('setting_code', $code)
                ->update([
                    'setting_value' => $val
                ]);
        }
    }

    public static function getSetting($code) {
        return DB::table('table_server_settings')
            ->where('setting_code', $code)
            ->select('table_server_settings.setting_code', 'table_server_settings.setting_value')
            ->get();
    }

    public function createCompetition($data) {

        if (isset($data['users_link']))
            $userLink = 1;
        else
            $userLink = 0;

        if (isset($data['users_count']))
            $userCount = 1;
        else
            $userCount = 0;

        return DB::table('table_competitions')
            ->insert([
                'title_post' => $data['title_post'],
                'post_content' => $data['post_content'],
                'finish_post_content' => $data['finish_post_content'],
                'users_link' => $userLink,
                'users_count' => $userCount,
                'winners_count' => $data['winners_count'],
                'status' => 0,
                'post_start' => Carbon::parse($data['post_start']),
                'post_end' => Carbon::parse($data['post_end']),
                'post_channels' => serialize($data['post_channels']),
                'subscribe_channels' => serialize($data['subscribe_channels']),
            ]);
    }

    public function getCompetitions() {
        return DB::table('table_competitions')
            ->select('table_competitions.*')
            ->get();
    }

}

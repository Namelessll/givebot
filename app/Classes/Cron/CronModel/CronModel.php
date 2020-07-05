<?php

namespace App\Classes\Cron\CronModel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CronModel extends Model
{
    public static function getUnProcessCompetition() {
        return DB::table('table_competitions')
            ->where('status', 0)
            ->select('table_competitions.*')
            ->get();
    }

    public static function getProcessCompetition() {
        return DB::table('table_competitions')
            ->where('status', 1)
            ->select('table_competitions.*')
            ->get();
    }

    public static function updateCompetition($id, $status) {
        return DB::table('table_competitions')
            ->where('id', $id)
            ->update([
               'status' => $status
            ]);
    }

    public static function getUsersCountForCompetition($id) {
        return DB::table('table_users_for_competition')
            ->where('competition_id', $id)
            ->count();
    }

    public static function getUsersForCompetition($id) {
        return DB::table('table_users_for_competition')
            ->where('competition_id', $id)
            ->select('table_users_for_competition.*')
            ->get();
    }

    public static function getUserInfo($userId) {
        return DB::table('table_bot_users')
            ->where('table_bot_users.user_id', $userId)
            ->select('table_bot_users.*')
            ->get();
    }

    public static function removeUserIfHerExist($id, $userId) {
        if (DB::table('table_users_for_competition')->where('table_users_for_competition.user_id_link', $userId)->exists())
            return DB::table('table_users_for_competition')
                ->where('table_users_for_competition.user_id_link', $userId)
                ->delete();
    }

    public static function addUserToCompetition($id, $userId) {
        $res = DB::table('table_users_for_competition')
            ->where('table_users_for_competition.user_id_link', $userId)
            ->doesntExist();
        if ($res)
            return DB::table('table_users_for_competition')
                ->insertGetId([
                    'user_id_link' => $userId,
                    'competition_id' => $id,
                    'created_at' => Carbon::now()
                ]);
        else
            return false;

    }

}

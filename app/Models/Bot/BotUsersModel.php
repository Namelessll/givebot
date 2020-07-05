<?php

namespace App\Models\Bot;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BotUsersModel extends Model
{
    public static function registerUserIfNoExist($userId, $inviteId, $username, $name) {
        if (DB::table('table_bot_users')->where('user_id', $userId)->doesntExist()) {
            DB::table('table_bot_users')
                ->insert([
                   'user_id' => $userId,
                   'invite_id' => $inviteId,
                   'username' => $username,
                   'name' => $name ?? '',
                   'created_at' => Carbon::now()
                ]);
            return true;
        } else {
            return false;
        }
    }
}

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

    public static function updateCompetition($id) {
        return DB::table('table_competitions')
            ->where('id', $id)
            ->update([
               'status' => 1
            ]);
    }
}

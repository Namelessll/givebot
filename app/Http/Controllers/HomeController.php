<?php

namespace App\Http\Controllers;

use App\Classes\Cron\CronModel\CronModel;
use App\Models\Dashboard\ServicesModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['rules'] = CronModel::getSettingByCode('rules')[0]->message_text;
        return view('home', $data);
    }

    public function getCompetitionCreatePage() {
        return view('pages.competition.create');
    }

    public function getCompetitionListPage() {
        $servicesModel = new ServicesModel();
        $data['competitions'] = $servicesModel->getCompetitions();

        return view('pages.competition.list', $data);
    }

    public function saveRules(Request $request) {
        CronModel::setSettingByCode('rules', $request->get('rules'), 0);
        return redirect()->back();
    }
}

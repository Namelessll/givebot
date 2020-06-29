<?php

namespace App\Http\Controllers;

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
        return view('home');
    }

    public function getCompetitionCreatePage() {
        return view('pages.competition.create');
    }

    public function getCompetitionListPage() {
        $servicesModel = new ServicesModel();
        $data['competitions'] = $servicesModel->getCompetitions();
        return view('pages.competition.list', $data);
    }
}

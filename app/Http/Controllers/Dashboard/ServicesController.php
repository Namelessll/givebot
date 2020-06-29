<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\ServicesModel;
use Illuminate\Http\Request;
use Telegram;

class ServicesController extends Controller
{
    private static $_token = "1262368552:AAGJmetULW8SxPZ3fMaZ1rh4JwI4eeQsT10";
    public function setWebhook(Request $request) {
        $_host = ServicesModel::getSetting('domain_address')[0]->setting_value;
        $result = Telegram::setWebhook([
            'url' => $_host . '/' . self::$_token . '/webhook'
        ]);
        $status = Telegram::getWebhookInfo();

        return redirect()->back()->with('status', (string) $status);
    }

    public function removeWebhook(Request $request) {
        $response = Telegram::removeWebhook();
        return redirect()->back()->with('status', serialize($response));
    }

    public function setApiDomain(Request $request) {
        $servicesModel = new ServicesModel();
        $servicesModel->setSetting('domain_address', $request->get('domain_address'));
        return redirect()->back()->with('status', 'Address was set');
    }

    public function createCompetition(Request $request) {
        $servicesModel = new ServicesModel();
        $servicesModel->createCompetition($request->all());
        return redirect()->back()->with('status', 'Competition was set');
    }

}

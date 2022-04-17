<?php

namespace App\Http\Controllers\Account\Telegram;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use pschocke\TelegramLoginWidget\Facades\TelegramLoginWidget;

class TelegramCallbackController extends Controller
{
    public function __invoke(Request $request) {
        if(!$telegramUser = TelegramLoginWidget::validate($request)) {
            return redirect()->back()->with('error', 'Error login telegram!');
        }

        Auth::user()->update([
            'telegram_id' => $telegramUser->get('id')
        ]);

        return redirect()->back()->with('success', 'You logged in into telegram');
    }
}

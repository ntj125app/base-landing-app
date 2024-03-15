<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function landingPage(Request $request): View
    {
        Log::debug('Landing page accessed', ['request' => $request->all(), 'remoteIp' => $request->ip()]);

        return view('base-components.base-vue', [
            'pageTitle' => 'Landing Page',
        ]);
    }
}

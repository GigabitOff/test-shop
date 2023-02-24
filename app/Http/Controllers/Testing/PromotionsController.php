<?php

namespace App\Http\Controllers\Testing;

use App\Actions\Promotions\DeactivateOutdated;
use App\Http\Controllers\Controller;

class PromotionsController extends Controller
{
    public function deactivate()
    {
        app()->make(DeactivateOutdated::class)();
        return view('testing.simple-response', [
            'message' => 'OK',
        ]);
    }

}

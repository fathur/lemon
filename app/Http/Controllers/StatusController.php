<?php

namespace App\Http\Controllers;

use App\Events\NewStatusEvent;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function store(Request $request)
    {
        $user = \Auth::user();

        $status = $user->statuses()->create([
            'text'  => $request->get('status')
        ]);


        broadcast(new NewStatusEvent($status))->toOthers();

        return $status;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ServerReport;

class Queue extends Controller
{
    //
    public function getTicket(Request $request)
    {
        if (isset($request->memberId)) {
            dispatch(new ServerReport($request->memberId, $request->ticketId));
        } else {
            return generateFailedResponse('no id');
        }
    }
}

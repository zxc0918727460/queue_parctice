<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Models\Orders;
use Carbon\Carbon;
use Log;
use App\Services\TicketService;

class TicketController extends Controller
{
    //

    function __construct(TicketService $ticketService)
    {
        $this->logTimestamp = floor(microtime(true) * 1000);
        config([
            'logID' => $this->logTimestamp
        ]);
        $this->ticketService = $ticketService;
    }

    public function getTicket(TicketRequest $request)
    {
        $ticketService = $this->ticketService;
        $responseContent = $ticketService->processTicket($request->memberId, $request->ticketId);

        $response = response(json_encode($responseContent, JSON_UNESCAPED_UNICODE), 200);
        return $response;
    }
}

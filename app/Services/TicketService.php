<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\Orders;
use Carbon\Carbon;
use Log;

class TicketService
{
    public function processTicket($memberId, $ticketId)
    {
        $Ticketmodel = new Ticket();
        $Ordersmodel = new Orders();

        $micro = intval(microtime(true) * 1000000);
        $now = Carbon::now()->micro($micro);

        if ($Ordersmodel->checkOrderExists($memberId, $ticketId)) {
            // true = overbooking
            $micro = intval(microtime(true) * 1000000);
            $now = Carbon::now()->micro($micro);

            Log::info("overbooking error memberId : {$memberId} | ticketId : {$ticketId} | time : {$now}");
            return createResponseContent(
                200,
                'this member overbooking error'
            );
        }


        if ($Ticketmodel->takeTicket($ticketId)) {
            $Ordersmodel->createOrders($memberId, $ticketId);
            Log::info("success createOrders memberId : {$memberId} | ticketId : {$ticketId} | time : {$now}");
        } else {
            Log::info("no more ticket error memberId : {$memberId} | ticketId : {$ticketId} | time : {$now}");
            return createResponseContent(
                200,
                'no more ticket'
            );
        }
    }
}

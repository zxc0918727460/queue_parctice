<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\TicketService;

class ServerReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $memberId, $ticketId;

    /**
     * Create a new job instance.
     */
    public function __construct($memberId, $ticketId)
    {
        $this->memberId = $memberId;
        $this->ticketId = $ticketId;
    }

    /**
     * Execute the job.
     */
    public function handle(TicketService $ticketService)
    {
        //
        $responseContent = $ticketService->processTicket($this->memberId, $this->ticketId);
    }
}
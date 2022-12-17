<?php

namespace App\Queries;

use App\Models\Ticket;

class SpecialQueries
{
    public static function ticketCounter(): array
    {
        $new = Ticket::where('status', 'new')
            ->get()
            ->count();
        $open = Ticket::where('status', 'open')
            ->get()
            ->count();
        $closed = Ticket::where(['status' => 'closed'])
            ->get()
            ->count();

        return [
            'newCount' => $new,
            'openCount' => $open,
            'closedCount' => $closed
        ];
    }
}

<?php

namespace App\Queries;

use DateTime;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

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
        $due = Ticket::where('status', '!=', 'new')
            ->where('assigned_to', Auth::user()->id)
            ->get()
            ->filter(function ($value, $key) {
                // Set the target date in the future
                $target_date = $value->due_date;

                // Get the current date and time
                $current_date = new DateTime();

                // Calculate the difference between the two dates
                $difference = $current_date->diff(new DateTime($target_date));

                if ($difference->days <= 2) {

                    return $value;
                }
                // Check if the difference is less than or equal to 2 days
            })->count();

        return [
            'newCount' => $new,
            'openCount' => $open,
            'closedCount' => $closed,
            'dueCount' => $due
        ];
    }
}

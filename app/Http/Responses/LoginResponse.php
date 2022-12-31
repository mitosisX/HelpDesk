<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        // $home = $this->getRedirect();

        if (Auth::user()->role_id === 1) {
            return redirect()
                ->route('admin.dashboard');
        } elseif (Auth::user()->role_id === 2) {
            return redirect()
                ->route('staff.tickets.view');
        } elseif (Auth::user()->role_id === 3) {
            return redirect()
                ->route('user.tickets.create');
        }
        // return redirect()->intended($home);
    }

    private function getRedirect()
    {
        if (Auth::user()->role_id === 1) return '/admin';
        else if (Auth::user()->role_id === 2) return '/staff';
        else if (Auth::user()->role_id === 3) return '/user';
    }
}

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
        } else {
            return redirect()
                ->route('staff.dashboard');
        }
        // return redirect()->intended($home);
    }

    private function getRedirect()
    {
        if (auth()->user()->role === 1) return '/admin';
        else if (auth()->user()->role === 2) return '/staff';
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( $user = $request->user() )
        {
            if ( $user->isAdmin() )
            {
                return $next( $request );
            }
        }
        
        return redirect()->guest( '/login' );

    }
}

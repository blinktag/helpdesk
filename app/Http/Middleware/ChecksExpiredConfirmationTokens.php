<?php

namespace App\Http\Middleware;

use Closure;

class ChecksExpiredConfirmationTokens
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $redirect)
    {
        if ($request->confirmation_token->isExpired()) {
            return redirect($redirect)->withError('Confirmation token has expired');
        }

        return $next($request);
    }
}

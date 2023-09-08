<?php

namespace App\Http\Middleware;

use App\Constants\ApiMessages;
use Closure;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponder;
use Illuminate\Support\Facades\App;

class SetAppLang
{
    use ApiResponder;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(! in_array($request->header('Content-Language'), config('app.available_locales'))) {
            return $this->errorResponse(__(ApiMessages::MSG_LANGUAGE_NOT_SUPPORTED));
        }

        App::setLocale($request->header('Content-Language'));
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Company;

class Client
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
        if (! Auth::check()) {
        return redirect()->route('/');
         }

          if($loguser->type == 'client' && is_null($company))
            {
                    return redirect()->to('/add_company');
            }


         if(auth()->user()->type == 'client' && !is_null($company))
            {
                return $next($request);
            }
         // if(auth()->user()->is_admin == 1)
         // {
         // return $next($request);
         // }
         else
         {
            abort('404');
         }
        // return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Report;

class CheckNewReport
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
        $new_submissions = Report::newSubmissions();

        session(['new_submissions' => $new_submissions]);

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\siteMainten;

class siteMaintenn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $d = siteMainten::first();
        if($d->status == '1'){
            return $next($request);
        }else{
            return redirect(route('maintenance'));
        }
    }
}

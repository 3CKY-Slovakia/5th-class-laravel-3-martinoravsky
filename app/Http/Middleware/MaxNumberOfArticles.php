<?php

namespace App\Http\Middleware;
use Closure;

use Illuminate\Support\Facades\Auth;

class MaxNumberOfArticles
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->numberOfArticles()>=2){
            return redirect('/articles/limitreached');
        }else{
        return $next($request);}
    }
}

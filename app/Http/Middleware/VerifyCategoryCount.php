<?php

namespace App\Http\Middleware;

use Closure;

use App\Category;

class VerifyCategoryCount
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
        if (Category::all()->count()==0) {
            session()->flash('error','You need to create Category first!');
            return redirect(route('noob.create'));
        }

        return $next($request);
    }
}

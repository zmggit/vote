<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Controller;

class CheckToken extends Controller
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
        if ($request->get('api_token')!='123')
        {
            return $this->jsonResponse(1422, '请先登录');
        }
        return $next($request);
    }
}

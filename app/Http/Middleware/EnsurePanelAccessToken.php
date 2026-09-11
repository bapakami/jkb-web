<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePanelAccessToken
{
    public function handle(Request $request, Closure $next): Response
    {
        if ((bool) config('app.hide_admin', false)) {
            if ($request->session()->get('admin_token_verified')) {
                return $next($request);
            }

            $expected = (string) config('app.admin_test_token', '');
            $given = (string) $request->query('admin_token', '');

            if ($expected === '' || ! hash_equals($expected, $given)) {
                abort(404);
            }

            $request->session()->put('admin_token_verified', true);
        }

        return $next($request);
    }
}
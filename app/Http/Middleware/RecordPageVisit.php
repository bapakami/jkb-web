<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecordPageVisit
{
    protected array $excludedPrefixes = ['admin', 'up'];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldRecord($request, $response)) {
            PageVisit::create([
                'url' => '/' . ltrim($request->path(), '/'),
                'ip_address' => $request->ip(),
                'user_agent' => mb_substr((string) $request->userAgent(), 0, 500),
                'visited_at' => now(),
            ]);
        }

        return $response;
    }

    protected function shouldRecord(Request $request, Response $response): bool
    {
        if (! $request->isMethod('GET') || $response->getStatusCode() !== 200) {
            return false;
        }

        if ($request->expectsJson() || $request->ajax() || $request->isPrecognitive()) {
            return false;
        }

        $path = '/' . ltrim($request->path(), '/');

        foreach ($this->excludedPrefixes as $prefix) {
            if ($path === '/' . $prefix || str_starts_with($path, '/' . $prefix . '/')) {
                return false;
            }
        }

        $userAgent = trim((string) $request->userAgent());

        if ($userAgent === '') {
            return false;
        }

        if (preg_match('/(bot|crawl|spider|slurp|monitor(ing)?|uptime|curl|wget|python-requests|postman|httpie|go-http-client|headless|facebookexternalhit|pingdom)/i', $userAgent)) {
            return false;
        }

        return true;
    }
}
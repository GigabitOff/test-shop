<?php

namespace App\Http\Middleware;

use App\Jobs\SiteReferrerResolve;
use App\Models\SiteReferrer;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SiteReferrerCounter
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($referrer = $request->headers->get('referer')) {
            $this->logReferrer($referrer);
        }

        return $next($request);
    }

    protected function logReferrer(string $referrerUrl): void
    {
        $referrerHost = parse_url($referrerUrl, PHP_URL_HOST);
        $currentHost = parse_url(url('/'), PHP_URL_HOST);

        if ($referrerHost === $currentHost) {
            // Dont log self referrer.
            return;
        }

        $hash = md5($referrerUrl);
        if ($saved = SiteReferrer::query()->whereHash($hash)->first()) {
            $saved->increment('quantity');
        } else {
            $referrer = SiteReferrer::create([
                'hash' => $hash,
                'referrer_url' => $referrerUrl,
            ]);

            // ToDo: Когда включатся очереди, убрать AfterResponse
            // что бы не тормозить пользовательский запрос
            SiteReferrerResolve::dispatchAfterResponse($referrer);
        }
    }
}

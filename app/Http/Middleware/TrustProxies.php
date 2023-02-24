<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies = [
        '173.245.48.0/20',
        '103.21.244.0/22',
        '103.22.200.0/22',
        '103.31.4.0/22',
        '141.101.64.0/18',
        '108.162.192.0/18',
        '190.93.240.0/20',
        '188.114.96.0/20',
        '197.234.240.0/22',
        '198.41.128.0/17',
        '162.158.0.0/15',
        '104.16.0.0/13',
        '104.24.0.0/14',
        '172.64.0.0/13',
        '131.0.72.0/22',
    ];

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     *
     * @throws HttpException
     */
    public function handle(Request $request, Closure $next)
    {
        $this->revalidateHeaders($request->headers);

        return parent::handle($request, $next);
    }

    /**
     * Push headers with missing values.
     *
     * Note: cf-connecting-ip is exclusive header of CloudFlare
     * see: https://developers.cloudflare.com/fundamentals/get-started/http-request-headers/
     *
     * @param HeaderBag $headers
     * @return void
     */
    protected function revalidateHeaders(HeaderBag $headers): void
    {

        if ($headers->has('cf-connecting-ip')
            && ! $headers->has('x_forwarded_for')) {

            $headers->set('x_forwarded_for', $headers->get('cf-connecting-ip'));
        }
    }

}

<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Config;

class VerifyCsrfMiddleware extends \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken {

    public function handle($request, Closure $next)
    {
        if ($this->isReading($request) || $this->excludedRoutes($request) || $this->tokensMatch($request))
        {
            return $this->addCookieToResponse($request, $next($request));
        }

        throw new TokenMismatchException;
    }

    protected function excludedRoutes($request)
    {
        $routes=array();
        $routes[] = Config::get('indipay.remove_csrf_check');
        $routes[] = 'razorpay-payment';
        $routes[] = 'indipay-successful-response';
        $routes[] = 'indipay-cancle-response';
        $routes[] = 'confirm';
    
        foreach($routes as $route)
            if ($request->is($route))
                return true;

        return false;
    }
}
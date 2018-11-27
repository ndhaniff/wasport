<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/user/upload",
        "https://payment.ipay88.com.my/*",
        "/payment/ipay88/callback",
        "/payment/ipay88/backendcallback"
    ];
}

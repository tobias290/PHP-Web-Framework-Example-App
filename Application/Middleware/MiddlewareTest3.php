<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 18/02/2018
 * Time: 12:35
 */

namespace App\Middleware;

use Framework\Http\Middleware\Middleware;

class MiddlewareTest3 implements Middleware {
    public function handle($request, $next) {
        echo "In Middleware 3 <br>";

        return $next();
    }
}
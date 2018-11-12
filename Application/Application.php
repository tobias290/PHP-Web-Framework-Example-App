<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 22/02/2018
 * Time: 17:13
 */

namespace App;

use Framework\BaseApplication;

use App\Commands\TestCommand;
use App\Middleware\{MiddlewareTest, MiddlewareTest2, MiddlewareTest3};
use App\Tables\{Contact, Test};

class Application extends BaseApplication {
    public function commands(): array {
        return [
            TestCommand::class,
        ];
    }

    public function tables(): array {
        return [
            Contact::class,
            Test::class
        ];
    }

    public function globalMiddleware(): array {
        return [
            MiddlewareTest::class
        ];
    }

    public function routeMiddleware(): array {
        return [
            "test" => MiddlewareTest2::class,
            "test_2" => MiddlewareTest3::class,
        ];
    }
}
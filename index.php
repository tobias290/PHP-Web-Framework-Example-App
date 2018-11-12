<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 17/02/2018
 * Time: 18:16
 */

require_once "Framework/vendor/autoload.php";
require_once "Framework/exception_handler.php";

use App\Application;

$application = new Application();

$application->run();
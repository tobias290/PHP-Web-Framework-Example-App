<?php

require_once __DIR__ . "/Framework/vendor/autoload.php";

$app = new \App\Application();
$app->runConsole($argv, $argc);

exit;
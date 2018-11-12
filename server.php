<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 19/06/2017
 * Time: 17:04
 */

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if(file_exists(__DIR__ . "/public" . $path)) {
    return false;
}

require_once __DIR__ . "/index.php";
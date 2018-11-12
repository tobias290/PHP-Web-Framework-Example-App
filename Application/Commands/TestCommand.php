<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 11/11/2018
 * Time: 22:19
 */

namespace App\Commands;


use Framework\Console\Commands\Command;

class TestCommand extends Command {
    protected static $name = "test";
    protected static $description = "Simple user defined command";
    protected static $help = "Example user defined command to show they work";

    public function execute() {
       echo "Command Works";
    }

}
<?php

/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 18/02/2018
 * Time: 18:42
 */

namespace App\Tables;

use Framework\Database\Relationships\ManyToMany;
use Framework\Database\Table;
use Framework\Database\Types\Integer;

class Test extends Table {
    protected static $table_name = "other_test";

    public $test;
    public $test_key;

    public function __construct() {
        parent::__construct();
        $this->test = new Integer();
        $this->test_key = new ManyToMany(self::class, Contact::class, "tests_contacts");
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 18/02/2018
 * Time: 18:41
 */

namespace App\Tables;

use Framework\Database\Table;
use Framework\Database\Types\{
    Integer,
    VarChar
};

class Contact extends Table {
    protected static $table_name = "contact";

    public $first_name;
    public $last_name;
    public $postcode;
    public $age;

    public function __construct() {
        parent::__construct();
        $this->first_name = new VarChar([
            "not_null" => true,
            "length" => 20
        ]);

        $this->last_name = new VarChar([
            "not_null" => true,
            "length" => 20
        ]);

        $this->postcode = new VarChar([
            "not_null" => true,
            "length" => 10
        ]);

        $this->age = new Integer([
            "not_null" => true
        ]);
    }
}
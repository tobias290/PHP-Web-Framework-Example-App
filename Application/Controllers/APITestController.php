<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 20/05/2017
 * Time: 10:56
 */

namespace App\Controllers;

use Framework\Controllers\APIController;
use Framework\Http\Requests\Request;

class APITestController extends APIController {
    public function get(Request $request) {
        $vars = [
            "start" => "start",
            "end" => "end"
        ];

        return $this->view->load($vars, $as="json");
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 19/02/2018
 * Time: 21:30
 */

namespace App\Controllers;


use Framework\Controllers\ClassController;
use Framework\Http\Requests\Request;

class ClassControllerTest extends ClassController {
    public function get(Request $request) {
        return $this->view->load("class_controller_view.php");
    }

    public function post(Request $request) {
        echo $request->post("name");
        return $this->view->load("class_controller_view.php");
    }
}
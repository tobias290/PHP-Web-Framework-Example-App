<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 29/05/2017
 * Time: 19:39
 */

namespace App\Controllers;

use Framework\Controllers\AnnotationController;
use Framework\Http\Requests\Request;

class AnnotationControllerTest extends AnnotationController {

    public function get(Request $request){
        return $this->view->load("action_controller_view.php");
    }

    /**
     * @Path /action/other_test/
     * @Methods POST
     * @Name other_test
     */
    public function test(Request $request) {
        return $this->router->redirect("test", ["id" => $request->post("id")]);
    }

    /**
     * @Path /action/other/
     * @Methods POST, GET
     * @Name other
     */
    public function toOther(Request $request) {
        return $this->router->redirect("other");
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 10/01/2017
 * Time: 21:31
 */

namespace App\Controllers;

use Framework\Controllers\Controller;
use Framework\Http\Requests\Request;

class TestController extends Controller {

    public function test(Request $request) {
        if($request->method == "POST") {
            if(!$request->post("name")->isEmpty()) $request->session->set("name", $request->post("name"));

            if(!$request->post("page")->isEmpty())
                return $this->router->redirect("test", ["id" => $request->post("page")]);
            else
                return $this->router->redirect("test", ["id" => $request->params["id"]]);
        } else {
            $vars = [
                "user" => $request->user,
                "start" => "Hello World",
                "end" => "Goodbye World",
                "type" => "GET method",
                "current_route" => $this->getCurrentRoute(),
                "current_id" => $request->params["id"],
                "name" => !$request->session->get("name")->isEmpty() ? $request->session->get("name") : null,
                "range" => $request->session->get("id"),
            ];
            return $this->view->load("test_view.php", $vars);
        }
    }

    public function other(Request $request) {
        return $this->view->load("other_test_view.php");
    }

    public function mailer(Request $request) {
        if($request->method == "POST") {
            $mailer = new \Framework\Mail\Mailer();

            $message = $mailer->getSwiftMessage((string)$request->post("subject"));

            $message
                ->setFrom(["tobiascompany@gmail.com" => "Tobias Essex"])
                ->setTo([(string)$request->post("to")])
                ->setBody((string)$request->post("body"));

            $mailer->send($message);

            return $this->view->load("mail_view.php");
        } else {
            return $this->view->load("mail_view.php");
        }
    }

    public function sms(Request $request) {
        if($request->method == "POST") {
            \Framework\SMS\SMS::send($request->post("to"), $request->post("message"));

            return $this->router->redirect("test", ["id" => 1]);
        } else {
            return $this->view->load("sms_test_view.php");
        }
    }
}
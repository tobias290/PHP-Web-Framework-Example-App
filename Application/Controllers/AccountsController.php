<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 18/02/2018
 * Time: 18:30
 */

namespace App\Controllers;

use Framework\Controllers\Controller;
use Framework\Http\Requests\Request;
use Framework\Security\Auth\Auth;

use App\Forms\LoginForm;
use App\Forms\UserForm;

class AccountsController extends Controller {

    public function login(Request $request) {
        if($request->method == "POST") {
            $form = new UserForm($request);

            $user = Auth::authenticate($form->username->getValue(), $form->password->getValue());

            Auth::login($request, $user);

            return $this->router->redirect("test", ["id" => 1]);
        } else {
            $form = new LoginForm($request);

            return $this->view->load("login_view.php", ["form" => $form]);
        }
    }

    public function logout(Request $request) {
        if($request->user != null)
            Auth::logout($request);

        return $this->router->redirect("test", ["id" => 1]);
    }

    public function addUser(Request $request) {
        if($request->method == "POST") {
            $form = new UserForm($request);

            if($form->password->getValue() != $form->confirm_password->getValue()) {
                return $this->view->load("add_user_view.php", ["form" => $form, "error" => true]);
            }

            Auth::createUser(
                $form->username->getValue(),
                $form->password->getValue(),
                [
                    "email" => $form->email->getValue(),
                    "first_name" => $form->first_name->getValue(),
                    "last_name" => $form->last_name->getValue(),
                ]
            );

            return $this->router->redirect("test", ["id" => 1]);
        } else {
            $form = new UserForm($request);

            return $this->view->load("add_user_view.php", ["form" => $form]);
        }
    }
}
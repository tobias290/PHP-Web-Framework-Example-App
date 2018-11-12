<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 03/01/2018
 * Time: 18:00
 */

namespace App\Forms;

use Framework\Forms\Form;
use Framework\Forms\Types\Email;
use Framework\Forms\Types\Password;
use Framework\Forms\Types\SubmitInput;
use Framework\Http\Requests\Request;
use Framework\Security\Auth\Models\User;

class LoginForm extends Form {
    protected $model = User::class;
    protected $fields = ["username", "password", "submit"];

    protected $password;
    protected $confirm_password;
    protected $submit;

    public function __construct(Request $request) {
        $this->password = new Password(["label" => "Password: "]);
        $this->submit = new SubmitInput("Login");

        return parent::__construct($request);
    }
}
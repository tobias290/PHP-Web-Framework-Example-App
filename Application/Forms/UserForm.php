<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 21/06/2017
 * Time: 19:35
 */

namespace App\Forms;

use Framework\Forms\Form;
use Framework\Forms\Types\{Email, Password, SubmitInput};
use Framework\Http\Requests\Request;
use Framework\Security\Auth\Models\User;

class UserForm extends Form {
    protected $model = User::class;
    protected $fields = ["username", "password", "confirm_password", "email", "first_name", "last_name", "submit"];

    protected $password;
    protected $confirm_password;
    protected $email;
    protected $submit;

    public function __construct(Request $request) {
        $this->password = new Password(["label" => "Password: "]);
        $this->confirm_password = new Password(["label" => "Confirm: "]);
        $this->email = new Email(["label" => "Email: "]);
        $this->submit = new SubmitInput("Add User");

        return parent::__construct($request);
    }
}
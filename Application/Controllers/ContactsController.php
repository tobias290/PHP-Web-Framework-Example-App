<?php
/**
 * Created by PhpStorm.
 * User: tobys
 * Date: 18/02/2018
 * Time: 18:35
 */

namespace App\Controllers;

use Framework\Controllers\Controller;
use Framework\Database\DB;
use Framework\Http\Requests\Request;


class ContactsController extends Controller {
    public function viewContacts(Request $request) {
        return $this->view->load(
            "view_contacts_view.php",
            ["contacts" => DB::table("contact")->getAll()->all()]
        );
    }

    public function addContact(Request $request) {
        if($request->method == "POST") {
            /** @var \Framework\Database\Table $contacts */
            $contacts = DB::table("contact");

            $contacts->insert(
                [
                    "first_name" => $request->post("first_name"),
                    "last_name" => $request->post("last_name"),
                    "postcode" => $request->post("postcode"),
                    "age" => $request->post("age")
                ]
            );

            return $this->router->redirect("view-contacts");
        } else {
            return $this->view->load("add_contact_view.php");
        }
    }
}
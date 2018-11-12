<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 22/02/2018
 * Time: 17:58
 */

use Framework\Http\Routing\Router;


Router::group("test", function () {
    Router::match(["GET", "POST"], "test/{id}", "TestController#test")
        ->name("test")
        ->requirements(["id" => "/\d+/"])
        ->middleware("test_2");

    Router::get("other", "TestController#other")->name("other");
});


Router::get("view/contacts", "ContactsController#viewContacts")->name("view-contacts");
Router::match(["GET", "POST"], "add/contact", "ContactsController#addContact")->name("add-contact");

Router::match(["GET", "POST"], "mail", "TestController#mailer")->name("mail");

Router::match(["GET", "POST"], "login", "AccountsController#login")->name("login");
Router::get("logout", "AccountsController#logout")->name("logout");
Router::match(["GET", "POST"], "add/user", "AccountsController#addUser")->name("add-user");

Router::match(["GET", "POST"], "sms", "TestController#sms")->name("sms-test");

Router::match(["GET", "POST"], "api", "APITestController")->name("api");

//Router::get("action", "AnnotationControllerTest")->name("action-other_test");

Router::any("class/test", "ClassControllerTest");
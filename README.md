# Example Web App using the PHP Web Framework
 
Example of a basic project using my PHP Web App Framework.


### Folder Structure 

* __Base folder__: Generally the name of the application is the name of the base folder
    * [__Application__](#Application): Main folder for classes related to the application 
        * [__Application.php__](#Application/Application.php): Main application class where all database tables, controllers, forms and middleware are registers so they can be used
        * [__Commands__](#Application/Commands): All commands are stored here
        * [__Controllers__](#Application/Controllers): All controllers (each controls a single/multiple web pages) will be located here
        * [__Forms__](#Application/Forms): All form classes will be located here
        * [__Middleware__](#Application/Middleware): All middleware classes will be located here
        * [__Tables__](#Application/Tables): All database table classes will be located here
    * [__Framework__](Framework): The framework source code
    * [__public__](#~/public): public resources such as css, images, javascript will be located here
    * [__routes__](#~/routes): All route files will be stored here. Route files are used to define the routes that are typed into the URL to load certain controllers/views
    * [__views__](#~/views): All html files will be located here
    * __app__: Main file which is called in the console to do various commands
    * [__config.ini__](#~/config.ini): ALl config relating to the app are located in this ini file. E.g. Application config, Database information
    * __index.php__: Index page
    * __README.md__: Readme file with instruction on how to use the framework
    * __server.php__: Server scripts called when the server is loaded up

# Basic Set Up and Use

## Application

### Application/Application.php

```php
<?php

namespace App;

use Framework\BaseApplication;

use App\Commands\TestCommand;
use App\Middleware\{MiddlewareTest, MiddlewareTest2, MiddlewareTest3};
use App\Tables\{Contact, Test};

class Application extends BaseApplication {

    public function tables(): array {
        return [
            Contact::class,
            Test::class
        ];
    }

    public function globalMiddleware(): array {
        return [
            MiddlewareTest::class
        ];
    }

    public function routeMiddleware(): array {
        return [
            "test" => MiddlewareTest2::class,
            "test_2" => MiddlewareTest3::class,
        ];
    }
    
    public function commands(): array {
        return [
            Command::class,
        ];
    }
}
```

This class is used to register all classes used by the application:
* `tables`: This method returns an array of all tables that are in the database that are to be included in the application.
* `globalMiddleware`: Returns all global middleware. These middleware are executed on every route.
* `routeMiddleware`: Returns all middleware that aren't globally executed but instead can be added to individual routes using the key given.
* `commands`: Returns all user defined commands that are to be included in the application.

#

### Application/Commands

This directory holds all commands. 

A command is piece of code which is executed via the command line.

Example Command:

```php
<?php

namespace App\Commands;

use Framework\Console\Commands\Command;

class TestCommand extends Command {
    protected static $name = "test";
    protected static $description = "Simple user defined command";
    protected static $help = "Example user defined command to show they work";

    /**
     * Called when command is used in command line.
     */
    public function execute() {
       echo "Command Works";
    }

}
```

Simple command which can be executed on the command line by using.

A command as three static variables that should be defined:
* `protected static $name`: Name of the command
* `protected static $description`: Brief description of the command
* `protected static $help`: More detailed description is the user needs help on a command

Example use:

```
> php app test
Command Works

> php app test --desciption
Simple user defined command

> php app test --help
Example user defined command to show they work
```

<details>
<summary>View Builtin Commands:</summary>
<p>
    <ul>       
        <li><strong>Create Group</strong>: Creates a new auth group</li>
        <li><strong>Create Permission</strong>: Creates a new auth permission</li>
        <li><strong>Create User</strong>: Creates a new auth user</li>
        <li><strong>Migration</strong>: Executes a database migration</li>
        <li><strong>Show Table Columns</strong>: Displays all the columns in the table given</li>
        <li><strong>Show Tables</strong>: Displays all the tables in the database </li>
        <li><strong>SQL Query</strong>: Execute a SQL query</li>
        <li><strong>Truncate Table</strong>: Truncate a table</li>
        <li><strong>Drop Table</strong>: Drop a table</li>
        <li><strong>List Command</strong>: Lists all the commands available</li>
        <li><strong>Make New</strong>: Creates a new set of folders based of the given flags</li>
        <li><strong>Start Server</strong>: Starts the development server</li>
    </ul>
</p>
</details>

#

### Application/Controllers

This directory holds all controllers. 

A controller is a class with a bunch of methods of which all relate to either one or multiple urls.
When that URL is called the method related to url is called. 
The `Request $request` parameter is a instance of class which holds all information relating to the request. E.g. headers, query string, cookies, etc. 

##### Example Controller:

```php
<?php

namespace App\Controllers;

use Framework\Controllers\Controller;
use Framework\Http\Requests\Request;

class AccountsController extends Controller {
    public function login(Request $request) {
        # Do stuff when logging in...
    }

    public function logout(Request $request) {
        # Do stuff when logging out...
    }
}
```

Example of a simple controller which each function responding to a different url request.

#### Example Class Controller:

```php
<?php

namespace App\Controllers;

use Framework\Controllers\ClassController;
use Framework\Http\Requests\Request;

class ClassControllerTest extends ClassController {
    public function get(Request $request) {
         # Do stuff with GET request ...
    }

    public function post(Request $request) {
        # Do stuff with POST request...
    }
    
    # Put, Patch, Delete, Options are also supported 
}
```

Example of a simple controller which each function responding to the same url request but depending of the request method will decide which method is called.

#### Annotation Controller: 

```php
<?php

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
        # Do stuff when '/action/other_test/' url is requested ...
        # Only works when the request method is POST
    }

    /**
     * @Path /action/other/
     * @Methods POST, GET
     * @Name other
     */
    public function toOther(Request $request) {
        # Do stuff when '/action/other/' url is requested ...
        # Works when the request method is GET or POST
    }
}
```

Annotation controller is another way to create URL navigation with each function responding to different URLs and different request method types.

#### API Controller

```php
<?php

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
```

API controller is used to return content is a way a API would. The content can either be displayed as JSON or XML.

#

### Application/Forms

This directory holds all forms. 

A form is class in which all information relating a form can be defined so it does not have to be manually written in HTML.

Example Form:

```php
<?php

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
```

The form has two protected variables `$model` must be defined whereas `$fields` does not have to be.

* `protected $model`: This must be the table in which this form related to.
* `protected $fields`: If this is left undefined all the fields in the table will be used. Otherwise here you can list the name of the fields you want to include in the form.

<details>
<summary>View form field types:</summary>
<p>
    <ul>
        <li>Button</li>
        <li>Checkbox</li>
        <li>Color</li>
        <li>Date</li>
        <li>Date Time Local</li>
        <li>Email</li>
        <li>File</li>
        <li>Hidden</li>
        <li>Image</li>
        <li>Input Button</li>
        <li>Month</li>
        <li>Number</li>      
        <li>Output</li>
        <li>Password</li>
        <li>Radio</li>
        <li>Range</li>
        <li>Reset</li>
        <li>Search</li>
        <li>
            Select
            <ul>
                <li>Option Group</li>
                <li>Option</li>
            </ul>
        </li>
        <li>Submit Input</li>
        <li>Telephone</li>
        <li>Text Area</li>
        <li>Text Input</li>
        <li>Time</li>
        <li>URl</li>
        <li>Week</li>
    </ul>
</p>
</details>

#

### Application/Middleware

This directory holds all middleware. 

A middleware is layer between the request and response. A given middleware will be executed before the method in the controller.

Multiple middleware can be applied to a single route/url. In this case a queue will be formed and each middleware will be called in the order they are applied to the route.

Example Middleware:

```php
<?php

namespace App\Middleware;

use Framework\Http\Middleware\Middleware;

class MiddlewareTest implements Middleware {
    public function handle($request, $next) {
        echo "In Middleware 1 <br>";

        return $next();
    }
}
```

The `return $next()` will call the next middleware layer in the queue. If there is no middleware left to call it will call the controller method.

#

### Application/Tables

This directory holds all tables. 

A table class is a MySQL table is PHP form/code. Then a migration command is called it will read the class and turn it into a MySQL table. 

Example Table:

```php
<?php

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
```

The table has one variable that must be defined:
* `protected static $table_name`: The name to give the table

Each data type can take these given parameters in a list:
* `primary_key`: `true` if the column is to be a primary key.
* `not_null`: `true` if the column cannot be left empty.
* `unique`: `true` if the column has to be unique.
* `default`: Define a default value for the column.

Integer special parameters:
* `auto_increment`: The column will be automatically incremented based of the previous entities column value.

VarChar special parameters:
* `length`: Length of the var char.

<details>
<summary>View MySQL data types available in PHP:</summary>
<p>
    <ul>
        <li>Boolean</li>
        <li>Date</li>
        <li>Date Time</li>
        <li>Integer</li>
        <li>Other</li>
        <li>Text</li>
        <li>VarChar</li>
    </ul>
</p>
</details>

#### Relationships 

A column may also be a relationship.

<details>
<summary>Available relationships:</summary>
<p>
    <ul>
        <li>Foriegn Key</li>
        <li>Many to Many</li> 
        <li>One to One</li> 
    </ul>
</p>
</details>

Example table with relationship: 

```php
<?php

namespace App\Tables;

use Framework\Database\Relationships\ManyToMany;
use Framework\Database\Table;
use Framework\Database\Types\Integer;

class Test extends Table {
    protected static $table_name = "other_test";

    public $test;
    public $test_key;

    public function __construct() {
        parent::__construct();
        $this->test = new Integer();
        $this->test_key = new ManyToMany(self::class, Contact::class, "tests_contacts");
    }
}
```

## ~/public

The public directory is for all files that will be publicly available such as CSS files, JavaScript files and images. 

## ~/routes

The routes directory is where all route files will go. Route files are where the routes are defines and URLs are linked to controllers.

Multiple route files can be created. The only purpose would be for organisation. 

Example Route File:

```php
<?php

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

Router::any("class/test", "ClassControllerTest");
```

Common router methods:
* `any`: Matches any request method
* `match`: Matches the request methods given
* `get`: Matches only the GET request method
* `group`: Any routes defines within the group will gave the given middleware applied to them

## ~/views

All views are stored here.

#

## ~/config.ini

```ini
[app]
name = WebSiteTest
debug = true
admin_panel = false
login_url = /login
```

Application section holds app information relating to main application .

* `name`: Name of the web application
* `debug`: Helps when in development. Display debug information (exceptions) when an error occurs. DO NOT use when deployed.
* `admin_panel`: When true the admin panel will be available (_Currently not implemented_).
* `login_url`: Main URL to send any users to when logging in and using the web framework user auth module. 

##

```ini
[template]
engine = php
```

This section tells the application what template engine to use.

* `engine`:
    * __framework_template_language__: Used the web frameworks own template engine
    * __php__: Used PHP's syntax 
    
##

```ini
[database]
engine = mysql
host = localhost
user = root
password = admin1234
database = admin_database
```

All information required to use the database is stored here. If a database if not being used then this section is not required.

* `engine`: Database dialect:
    * `mysql`: Use this variable to use MySQL 
    * `postgresql`: Use this variable to use PostgreSQL
    * `sqlite`: Not implemented
* `host`: Host that serves the database
* `user`: Username 
* `password`: Password 
* `database`: Name of the database 

##

```ini
[mail]
host = smtp.mailhost.com
username = example@mail.com
password = pass1234
encryption = tls
```

This section is not required unless the mail module is being used.
This module is a wrapper around the [Swift Mail Library](https://swiftmailer.symfony.com/).

* `host`: Host server
* `username`: Your username
* `password`: Your password
* `encryption`: Type of encryption being used. E.g. tls

##

```ini
[log]
date_format = h:i:s d-m-Y
log_migration = false
migration_path = .
log_path = .
log_file_name = log
```

Sets up needed information needed if the logging module is being used.

* `date_format`: Format for the date. 
    * Used the [PHP date format syntax](http://php.net/manual/en/datetime.formats.date.php).
* `log_migration`: If true when database migrations are made they will be logged.
* `migration_path`: Path to store the _'migration.log'_ file.
* `log_path`: Path to store the normal log file.
* `log_file_name`: Name of the log file.

##

```ini
[sms]
from = 123456789
api_key = API_KEY
api_secret = API_SECRET
```

Sets up information needed if the SMS module is being used. This module is a wrapper around the [Nexmo SMS Library](https://github.com/Nexmo/nexmo-php).

* `from`: SMS number to send from
* `api_key`: Your nexmo api key
* `api_secret`: Your nexmo api secret key
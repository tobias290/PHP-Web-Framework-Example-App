<? if(!is_null($user)): ?>
    <h1>Welcome <?= $user->getFirstName(); ?></h1>
<? endif; ?>

<? $this->include("views/template.php", $with=["page" => $current_id, "range" => $range]) ?>

<h3><?= $type ?></h3>
<h3><?= $name ?></h3>
<h3><?= $test ?? null ?></h3>
<h3><?= $route_test ?? null ?></h3>

<ul>
    <li><?= $start ?></li>
    <li><?= $end ?></li>
    <li><?= $current_route ?></li>
    <li><?= $current_id ?></li>
</ul>

<? if(!empty($first_name)): ?>
    <h3>Hello <?= $first_name ?></h3>
<? endif ?>

<hr>
<?= $this->anchor("To Other", "other"); ?>
<hr>
<?= $this->anchor("Login", "login"); ?>
<br>
<?= $this->anchor("Logout", "logout"); ?>
<br>
<?= $this->anchor("Add User", "add-user"); ?>
<hr>
<?= $this->anchor("View Contacts", "view-contacts"); ?>
<br>
<?= $this->anchor("To Mail", "mail"); ?>
<br>
<?= $this->anchor("To SMS Test", "sms-test"); ?>
<!--<br>-->
<?//= $this->anchor("To Action Test", "action-other_test"); ?>
<!--<br>-->
<?//= $this->anchor("To API", "api"); ?>
<hr>

<form action="<?= $this->getCurrentRoute() ?>" method="post">
    <?= $this->csrf_token() ?>
    <input type="text" name="page" placeholder="Enter page number">
    <input type="submit" value="Enter">
</form>

<form action="<?= $this->getCurrentRoute() ?>" method="post">
    <?= $this->csrf_token() ?>
    <input type="text" name="name" placeholder="Enter name">
    <input type="submit" value="Enter">
</form>

<img src="<?= $this->static("images/test.png") ?>">

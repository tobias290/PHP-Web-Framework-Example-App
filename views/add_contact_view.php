<a href="<?= $this->router->getRouteFromName("view-contacts") ?>">View Contacts</a>
<hr>

<form action="<?= $this->getCurrentRoute() ?>" method="post">
    <?= $this->csrf_token() ?>
    <label for="first_name">First Name: </label><input id="first_name" type="text" name="first_name">
    <br><br>
    <label for="last_name">Last Name: </label><input id="last_name" type="text" name="last_name">
    <br><br>
    <label for="postcode">Postcode: </label><input id="postcode" type="text" name="postcode">
    <br><br>
    <label for="age">Age: </label><input id="age" type="number" name="age">
    <br><br>
    <input type="submit" value="Add Contact">
</form>
<h1>Mail</h1>

<form action="<?= $this->getCurrentRoute() ?>" method="post">
    <label for="subject">Subject: </label><input type="text" id="subject" name="subject">
    <br><br>
    <label for="to">To: </label><input type="text" id="to" name="to">

    <br><br>
    <label for="body">Message Body:</label>
    <br>

    <textarea id="body" name="body" rows="10" cols="50"></textarea>

    <br>
    <input type="submit" value="Send">
</form>

<br>

<a href="<?= $this->router->getRouteFromName("other_test", ["id" => 5]) ?>">Back to Test</a>
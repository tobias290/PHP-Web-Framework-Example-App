<h1>Action Controller Test</h1>

<form action="<?= $this->getRouteFromActionName("other_test"); ?>" method="post">
    <input name="id">
    <input type="submit" value="Submit">
</form>

<form action="<?= $this->getRouteFromActionName("other"); ?>" method="post">
    <input type="submit" value="Other">
</form>
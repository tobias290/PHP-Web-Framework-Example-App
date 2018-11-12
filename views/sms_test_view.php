
<form action="<?= $this->getCurrentRoute() ?>" method="post">
    <label for="to">To: </label><input type="number" id="to" name="to"><br>
    <label for="message">Message: </label><br>
    <textarea id="message" name="message" rows="7" cols="30"></textarea><br>
    <input type="submit" value="Send Message">
</form>
<h1>Add User View</h1>

<? if(!empty($error)): ?>
    <h3 style="color: red;">Form was not filled in properly</h3>
<? endif ?>

<?= $form("/add/user", "POST") ?>

<hr>

<?= $this->anchor("To Test", "test", ["id" => "1"], ["title" => "To test page"]) ?>
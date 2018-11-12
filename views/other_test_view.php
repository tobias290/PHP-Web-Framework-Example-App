<? $this->extend("views/block_test_template.php") ?>

<? $this->set("title", "Other") ?>

<? $this->block("body") ?>
    <h2>Hello World</h2>
    <h3><?= $test ?></h3>
    <h3><?= $route_test ?></h3>
    <a href="<?= $this->router->getRouteFromName("test", ["id" => "1"]) ?>">To Test</a>
    <br><br>
<? $this->endblock() ?>
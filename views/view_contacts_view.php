<? $this->extend("views/block_test_template.php") ?>

<? $this->set("title", "View Contacts") ?>


<? $this->block("body") ?>
    <a href="<?= $this->router->getRouteFromName("add-contact") ?>">Add Contact</a> |
    <a href="<?= $this->router->getRouteFromName("test", ["id" => 5]) ?>">To Test</a>
    <hr>
    <table>
        <thead>
            <tr>
                <? foreach ($contacts[0]->asArray() as $key => $value): ?>
                    <th><?= $key ?></th>
                <? endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <? foreach ($contacts as $contact): ?>
                <tr>
                    <? foreach ($contact->asArray() as $value): ?>
                        <td><?= $value ?></td>
                    <? endforeach; ?>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>
<? $this->endblock() ?>
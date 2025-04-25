<?php
// Eltern-Kind-Verknüpfungsformular
?>
<form action="<?= PluginEngine::getLink($plugin, [], 'link') ?>" method="post">
    <label>Elternaccount:
        <input type="text" name="parent_id" required>
    </label>
    <label>Schüleraccount:
        <input type="text" name="student_id" required>
    </label>
    <button type="submit">Verknüpfen</button>
</form>

<table>
    <tr>
        <th>Eltern</th>
        <th>Schüler</th>
        <th>Bestätigt</th>
    </tr>
    <?php foreach ($relations as $rel): ?>
    <tr>
        <td><?= htmlReady($rel['parent']) ?></td>
        <td><?= htmlReady($rel['student']) ?></td>
        <td><?= $rel['verified'] ? '✅' : '❌' ?></td>
    </tr>
    <?php endforeach ?>
</table>
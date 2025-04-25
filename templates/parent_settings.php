<?php
// Eltern-Kind-Verknüpfungsformular
?>
<form action="<?= $controller->url_for('admin/link') ?>" method="post">
    <label>Eltern-ID: <input type="text" name="parent_id" required></label>
    <label>Schüler-ID: <input type="text" name="student_id" required></label>
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
        <td><?= htmlReady($rel['parent_id']) ?></td>
        <td><?= htmlReady($rel['student_id']) ?></td>
        <td><?= $rel['verified'] ? '✅' : '❌' ?></td>
    </tr>
    <?php endforeach ?>
</table>
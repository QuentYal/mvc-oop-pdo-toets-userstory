<h3><?= $data['title'] ?></h3>

<table border='1'>
    <thead>
        <th>Datum</th>
        <th>Tijd</th>
        <th>Instructeur</th>
        <th>instructeur info</th>
        <th>Mankementen</th>
    </thead>
    <tbody>
        <?= $data['rows'] ?>
    </tbody>
</table>
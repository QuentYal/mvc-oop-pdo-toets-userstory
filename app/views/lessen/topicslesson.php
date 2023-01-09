<h3><?= $data['title'] ?></h3>

<table border='1'>
    <thead>
        <th>
            Onderwerpen
        </th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
</table>
<br>
<a href="<?= URLROOT; ?>/lessen/addTopic/<?= $data['lesId']; ?>">
    <input type="button" value="Onderwerp toevoegen">
</a>
<h3><?= $data['title'] ?></h3>

<table border='1'>
    <thead>
        <th>
            Mankementen
        </th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
</table>
<br>
<a href="<?= URLROOT; ?>/mankementen/addMankementen/<?= $data['mankementijd']; ?>">
    <input type="button" value="Mankement toevoegen">
</a>
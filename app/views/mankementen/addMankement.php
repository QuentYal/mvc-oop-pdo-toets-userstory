<h3><?= $data['title']; ?></h3>

<form action="<?= URLROOT ?>/mankementen/addMankement" method="post">
    <label for="topic">Mankement</label><br>
    <input type="text" name="mankement" id="mankement"><br>
    <input type="hidden" name="lesId" value="<?= $data['mankementid']; ?>"><br>
    <input type="submit" value="Toevoegen">
</form>
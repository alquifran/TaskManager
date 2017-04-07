<h1>Listado de packs</h1>
<form method="POST" action="../addPack/">
    <?php foreach ($packs as $pack): ?>
        <input type="radio" name="pack" value="<?= $pack->getId(); ?>">
        <?= $pack->getName(); ?>
        <br>

    <?php endforeach ?>
    <input type="submit" name="Contratar" value="Contratar">
</form>
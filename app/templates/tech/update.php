<form method="POST">
	<label for="name">Nombre</label>
    <input type="text" name="name" required
        value="<?= $tech->getName() ?>" ><br>
	<label for="password">Contraseña</label>
    <input hidden="" type="password"  name="password"
        value=""><br>
	<label for="email">Email</label>
    <input type="email" name="mail"
    value="<?= $tech->getMail() ?>"><br>
    Alta: <input type="checkbox" value="1" name="alta" <?php if($tech->getAlta()){echo 'checked';}?>><br>
	<input type="submit" value="Modificar teche">
</form>
<br>
<a href='../profile/'><button>Volver al listado</button></a>
<br>
<a href='../showTech/<?= $tech->getTechById() ?>'><button>Cancelar</button></a>
<a href='../'><button>Volver al listado de techs</button></a>
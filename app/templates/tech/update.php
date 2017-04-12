<form method="POST">
	<label for="name">Nombre</label>
    <input type="text" name="name" required
        value="<?= $tech->getName() ?>" ><br>
	<label for="password">Crear nueva contraseña</label>
    <input type="password"  name="password"
        value="" minlength="6"><br>
	<label for="email">Email</label>
    <input type="email" name="mail"
    value="<?= $tech->getMail() ?>"><br>
    Alta: <input type="checkbox" value="1" name="alta" <?php if($tech->getAlta()){echo 'checked';}?>><br>
	<input type="submit" value="Modificar tech">
</form>
<br>
<a href='../profile/'><button>Volver al listado</button></a>
<a href='../showTech/<?= $tech->getId() ?>'><button>Cancelar</button></a>
<a href='../'><button>Volver al listado de techs</button></a>
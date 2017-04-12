<form method="POST">
	<label for="name">Nombre</label>
    <input type="text" name="name" required
        value="<?= $client->getName() ?>" ><br>
	<label for="password">Crear nueva contraseña</label>
    <input type="password"  name="password"
        value="" minlength="6"><br>
	<label for="email">Email</label>
    <input type="email" name="mail"
    value="<?= $client->getMail() ?>"><br>
    Alta: <input type="checkbox" value="1" name="alta" <?php if($client->getAlta()){echo 'checked';}?>><br>
	<input type="submit" value="Modificar cliente">
</form>
<br>
<a href='../profile/'><button>Volver al listado</button></a>
<a href='../showClient/<?= $client->getId() ?>'><button>Cancelar</button></a>
<a href='../listClient/'><button>Volver al listado de clientes</button></a>

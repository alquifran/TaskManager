<form method="POST">
	<label for="name">Nombre</label>
    <input type="text" name="name" required
        value="<?= $client->getName() ?>" ><br>
	<label for="password">Contraseña</label>
    <input hidden="" type="password"  name="password"
        value=""><br>
	<label for="email">Email</label>
    <input type="email" name="mail"
    value="<?= $client->getMail() ?>"><br>
	<input type="submit" value="Modificar cliente">
</form>
<br>
<a href='../profile'><button>Volver al listado</button></a>
<br>
<a href='../showClient/<?= $client->getClientById() ?>'><button>Cancelar</button></a>
<a href='../'><button>Volver al listado de clientes</button></a>

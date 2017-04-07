<?php $pageTitle = $client->getName() ?>
<h2>Nombre: <?= $client->getName() ?></h2>
<h2>Email: <?= $client->getMail() ?></h2>

<?php if (!$client->getAlta()){echo '
<style type="text/css">
	body{
	background-color:pink;}
</style>
<h2>Estado: Baja Temporal</h2>
';}else{
	echo "<h2>Estado: Alta</h2>";
	} ?>

<p>
<a href='../listClient/'><button>Ir al listado de clientes</button></a>
<a href='../updateClient/<?= $client->getId(); ?>'><button>Modificar</button></a>
<a href='../deleteClient/<?= $client->getId(); ?>'><button>Eliminar</button>
</a>
<?php $pageTitle = $client->getName() ?>
<h2>Nombre: <?= $client->getName() ?></h2>
<h2>Email: <?= $client->getMail() ?></h2>


<p>
<a href='../listClient/'><button>Volver al listado</button></a>
<a href='../updateClient/<?= $client->getId(); ?>'><button>Modificar</button></a>
<a href='../deleteClient/<?= $client->getId(); ?>'><button>Eliminar</button>
</a>
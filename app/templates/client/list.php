<h1>Listado de clientes</h1>
<ul>
	<?php foreach ($clients as $client): ?>
		<li>
		<a href='../showClient/<?= $client->getId(); ?>'><?= $client->getName(); ?></a>
			
		</li>
	<?php endforeach ?>
</ul>
<h1>Listado de técnicos</h1>
<ul>
	<?php foreach ($techs as $tech): ?>
		<li>
		<a href='../showTech/<?= $tech->getId(); ?>'><?= $tech->getName(); ?></a>
			
		</li>
	<?php endforeach ?>
</ul>


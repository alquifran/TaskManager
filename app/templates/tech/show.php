<?php $pageTitle = $tech->getName() ?>
<h2>Nombre: <?= $tech->getName() ?></h2>
<h2>Email: <?= $tech->getMail() ?></h2>

<?php if (!$tech->getAlta()){echo '
<style type="text/css">
	body{
	background-color:pink;}
</style>
<h2>Estado: Baja Temporal</h2>
';}else{
	echo "<h2>Estado: Alta</h2>";
	} ?>
<p>
<a href='../listTech/'><button>Ir al listado de técnicos</button></a>
<a href='../updateTech/<?= $tech->getId(); ?>'><button>Modificar</button></a>
<a href='../deleteTech/<?= $tech->getId(); ?>'><button>Eliminar</button>
</a>
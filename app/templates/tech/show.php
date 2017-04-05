<?php $pageTitle = $tech->getName() ?>
<h2>Nombre: <?= $tech->getName() ?></h2>
<h2>Email: <?= $tech->getMail() ?></h2>


<p>
<a href='../listTech/'><button>Volver al listado</button></a>
<a href='../updateTech/<?= $tech->getId(); ?>'><button>Modificar</button></a>
<a href='../deleteTech/<?= $tech->getId(); ?>'><button>Eliminar</button>
</a>
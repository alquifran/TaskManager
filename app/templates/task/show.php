<h1><?=$task->getName();?></h1>

Descripción: <?=$task->getDescription();?><br>

Cliente asignado: <a href="../showClient/<?=$task->getClientId()?>" target="_blank"><?=$task->getClient()->getName();?></a><br>

Técnico asignado: <a href="../showTech/<?=$task->getTechId()?>" target="_blank"><?=$task->getTech()->getName();?></a><br>

Estado de la tarea: <?=$task->getStatusText()?>

<form action="../deleteTask/<?=$task->getId()?>" method="POST">
	<input type="submit" name="submit" value="Eliminar tarea">
</form>
<h1><?=$task->getName();?></h1>

Descripción: <?=$task->getDescription();?><br>

Cliente asignado: <a href="../showClient/<?=$task->getClientId()?>" target="_blank"><?=$task->getClient()->getName();?></a><br>

Técnico asignado: <a href="../showTech/<?=$task->getTechId()?>" target="_blank"><?=$task->getTech()->getName();?></a><br>

Estado de la tarea: <?=$task->getStatusText()?>
<br>
<a href='../listTask/'><button>Ir al listado de tareas</button></a>
<a href='../updateTask/<?= $task->getId(); ?>'><button>Modificar</button></a>
<a href='../deleteTask/<?= $task->getId(); ?>'><button>Eliminar</button></a>


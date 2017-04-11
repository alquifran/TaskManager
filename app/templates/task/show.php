<h1><?=$task->getName();?></h1>

Descripción: <?=$task->getDescription();?><br>

Cliente asignado: <a href="../showClient/<?=$task->getClientId()?>" target="_blank"><?=$task->getClient()->getName();?></a><br>

Técnico asignado: <a href="../showTech/<?=$task->getTechId()?>" target="_blank"><?=$task->getTech()->getName();?></a><br>

Estado de la tarea: <?=$task->getStatusText()?>
<br>
Tiempo empleado en la tarea: <?=$task->getworkTimeAsMin()?>   minutos.
<br>
<a href='../listTask/'><button>Ir al listado de tareas</button></a>
<?php if($_SESSION['user_type'] == 'admin'){?>
<a href='../updateTask/<?= $task->getId(); ?>'><button>Modificar</button></a>
<a href='../deleteTask/<?= $task->getId(); ?>'><button>Eliminar</button></a><br>
<form method="POST" > 
Introduzca línea de tiempo en minutos (se sumará al tiempo actual): <br>
<input type="number" name="workTime" step="1" min = "1" required="">
<input type="submit" name="addTime" value="Añadir tiempo">
</form>
<?php } else if ($_SESSION['user_type'] == 'tech' && $task->getTechId() == null) {?>
<form method="POST">
<input type="submit" name="assign" value="Asignar tarea">
</form>

<?php }else{?>
<a href='../updateTask/<?= $task->getId(); ?>'><button>Modificar</button></a>

<form method="POST" > 
Introduzca línea de tiempo en minutos (se sumará al tiempo actual): <br>
<input type="number" name="workTime" step="1" min = "1" required="">
<input type="submit" name="addTime" value="Añadir tiempo">
</form>
<?php }?>
Hola cliente <?=$client->getName();?><br>
<?=$client->getMail();?>
<br>

<h2>Tareas asociadas a tu perfil: </h2>

		<?php
			if($tasks == null){
				echo "No hay tareas";
			}
			else{
				foreach ($tasks as $task) {
					echo $task->getName() . "--------". $task->getDescription() ."--------" . $task->getStatusText();				
					echo "<br>";
				}
			}


		?>
	<a href="../addTask/">Add Task</a>

	<?php //include '../task/list.php';?>
	<h2>Pack contratado actualmente: </h2>

		<?php
			if($packs == null){
				echo "No hay packs contratados";
			}
			else{
				foreach ($packs as $pack) {
					echo $pack->getName();
					echo "<br>";
				}
			}

		?>
	<!-- <h2>Contrata un Pack: </h2> -->





<br>
<br>
<br>
<form method="POST" action="../listPacks/">
	<input type="submit" name="packs" value="Contratar Pack">
</form>
<form method="POST">

		<input type="submit" name="logout" value="Cerrar sesión">
	</form>
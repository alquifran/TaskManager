
<h1 class="welcome">Bienvenido <?=$client->getName();?></h1><br>


<table class="tasks">
<tr><td colspan="4"><h3>Tareas asociadas a tu perfil: </h3></td></tr>
<th>Titulo</th>
<th>Descripción</th>
<th>Estado</th>
<th>Tiempo</th>

		<?php
			if($tasks == null){
				echo "<tr><td>No hay tareas</td></tr>";
			}
			else{
				foreach ($tasks as $task) {
					echo "<tr><td>" . $task->getName() . "</td>" . "<td>". $task->getDescription() ."</td><td>" . $task->getStatusText() . "</td><td>" . "</td></tr>";
					echo "<br>";
				}
			}


		?>
</table>
<table class="packs">
	<tr><td><h3>Pack contratado actualmente: </h3></td></tr>

		<?php
			if($packs == null){
				echo "<tr><td>No hay packs contratados</td></tr>";
			}
			else{
				foreach ($packs as $pack) {
					echo "<tr><td>".$pack->getName() ."</td></tr>";
				}
			}

		?>
</table>

	<!-- <h2>Contrata un Pack: </h2> -->





<!-- <br>
<br>
<br>
<form method="POST" action="../listPacks/">
	<input type="submit" name="packs" value="Contratar Pack">
</form>
<form method="POST">

		<input type="submit" name="logout" value="Cerrar sesión">
	</form> -->
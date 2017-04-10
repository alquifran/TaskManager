Editar tarea:
<form method="POST">
	Título: <input type="text" name="name" value="<?=$task->getName();?>" required=""
	<?php if(isset($isTech)){ ?>
		disabled=""
	<?php } ?>
	><br>
	Descripción: <input type="textarea" name="desc" value="<?=$task->getDescription();?>"><br>
	<?php if(!isset($isTech)){ ?>
	Asignar a un cliente: <br>
	<select name="client_id" >
		<option value=""></option>
		<?php foreach($clients as $client): ?>
			<option value="<?=$client->getId();?>"
				<?php echo $client->getId() == $task->getClientId() ? "selected = 'selected'" : "";
				?>>
				<?=$client->getName();?>
				
			</option>
		<?php endforeach;?>
	</select><br>
	Asignar a un técnico: <br>
	<select name="tech_id">
		<option value=""></option>
		<?php foreach($techs as $tech): ?>
			<option value="<?=$tech->getId();?>"
			<?php echo $tech->getId() == $task->getTechId() ? "selected = 'selected'" : "";
			?>>
				<?=$tech->getName();?>
				
			</option>
		<?php endforeach;?>
	</select><br>
	<?php } ?>

	<select name="status_id">
		<option value = '0' <?php if($task->getStatus() == 0) echo "selected=''" ?>>Por empezar</option>
		<option value = '1' <?php if($task->getStatus() == 1) echo "selected=''" ?>>Haciéndose</option>
		<option value = '2' <?php if($task->getStatus() == 2) echo "selected=''" ?>>Terminada</option>
	</select>

	<input type="submit" name="submit">

</form>

<a href="../listTask/"><button>Volver al listado de tareas</button></a>
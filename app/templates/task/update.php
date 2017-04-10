Editar tarea:
<form method="POST">
	Título: <input type="text" name="name" value="<?=$task->getName();?>" required=""><br>
	Descripción: <input type="textarea" name="desc" value="<?=$task->getDescription();?>"><br>
	Asignar a un cliente: <br>
	<select name="client_id">
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

	<input type="submit" name="submit">

</form>
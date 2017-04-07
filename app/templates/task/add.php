Crear tarea nueva:
<form method="POST">
	Título: <input type="text" name="name" ><br>
	Descripción: <input type="textarea" name="desc"><br>
	Asignar a un cliente: <br>
	<select name="client_id">
		<option value=""></option>
		<?php foreach($clients as $client): ?>
			<option value="<?=$client->getId();?>"><?=$client->getName();?></option>
		<?php endforeach;?>
	</select><br>
	Asignar a un técnico: <br>
	<select name="tech_id">
		<option value=""></option>
		<?php foreach($techs as $tech): ?>
			<option value="<?=$tech->getId();?>"><?=$tech->getName();?></option>
		<?php endforeach;?>
	</select><br>

	<input type="submit" name="submit">

</form>


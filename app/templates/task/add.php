Crear tarea nueva:
<form method="POST">
	Título: <input type="text" name="name" required=""><br>
	Descripción: <input type="textarea" name="desc"><br>
	
	Asignar a un cliente: <br>
	<select name="client_id" <?php if($_SESSION['user_type'] == 'tech') {echo "required";}?>>
		<option value=""></option>
		<?php foreach($clients as $client): ?>
			<option value="<?=$client->getId();?>"><?=$client->getName();?></option>
		<?php endforeach;?>
	</select><br>
	<?php if ($_SESSION['user_type'] == 'admin'){ ?>
	Asignar a un técnico: <br>
	<select name="tech_id">
		<option value=""></option>
		<?php foreach($techs as $tech): 
			if($_SESSION['user_type'] == 'admin'){?>
				<option value="<?=$tech->getId();?>"><?=$tech->getName();?></option>
			
		<?php }
		else if($_SESSION['user_type'] == 'tech' && $tech->getMail() == $_SESSION['mail']){
		?>

			<option value="<?=$tech->getId();?>"><?=$tech->getName();?></option>
		<?php  } endforeach;?>
	</select><br>
	<?php } else { ?>
	¿Asignar tarea a ti mismo? <input type="checkbox" name="self_assign" value="assign">
	<br>

	<?php } ?>

	<input type="submit" name="submit">

</form>


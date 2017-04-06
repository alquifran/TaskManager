Hola cliente <?=$client->getName();?><br>
<?=$client->getMail();?>
<br>
	<?php //include '../task/list.php';?> 
	<h2>Pack contratado actualmente: </h2>
	
		<?php 
			if($pack == null){
				echo "No hay pack contratado";
			}
			else{
				echo $pack->getName();
			}

		?>

	
<br>	<br>	<br>	
<form method="POST">
		<input type="submit" name="logout" value="Cerrar sesión">
	</form>
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
	<!-- <h2>Contrata un Pack: </h2> -->





<br>
<br>
<br>
<form method="POST" action="listPacks">
	<input type="submit" name="packs" value="Contratar Pack">
</form>
<form method="POST">

		<input type="submit" name="logout" value="Cerrar sesión">
	</form>
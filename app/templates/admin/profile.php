Hola admin <?=$admin->getName();?><br>
<?=$admin->getMail();?>
<br>
<form method="POST">
		<input type="submit" name="logout" value="Cerrar sesión">
	</form>
	<a href="../addClient/">Add Client</a>
	<?php //include '../task/list.php';?> 
Hola técnico <?=$tech->getName();?><br>
<?=$tech->getMail();?>
<br>
<br>

<a href="../listTask/">Lista de tareas</a>

<form method="POST">
		<input type="submit" name="logout" value="Cerrar sesión">
	</form>
	<?php //include '../task/list.php';?> 
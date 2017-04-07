Hola admin <?=$admin->getName();?><br>
<?=$admin->getMail();?>
<br>
<form method="POST">
		<input type="submit" name="logout" value="Cerrar sesión">
	</form>
	<a href="../addClient/">Add Client</a>
	<a href="../listClient/">Client List</a><br>
	<a href="../addTech/">Add Tech</a>
	<a href="../listTech/">Tech List</a><br>
	<a href="../addTask/">Add Task</a>
	<a href="../listTask/">Task List</a>
	<?php //include '../task/list.php';?> 
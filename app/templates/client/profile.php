Hola cliente <?=$client->getName();?><br>
<?=$client->getMail();?>
<br>
<form method="POST">
		<input type="submit" name="logout" value="Cerrar sesión">
	</form>
	<?php //include '../task/list.php';?> 
	<ul>
	<?php foreach ($packs as $pack): ?>
		<li><?= $pack->getName();?></li>
	<?php endforeach; ?>
	</ul>
<h1>Lista de tareas</h1>

<table>
	<thead>
		<tr>
			<th>
				Nombre
			</th>
			<th>
				Cliente
			</th>
			<th>
				Técnico
			</th>
			<th>
				Estado
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($tasks as $task):
		
		if  ($_SESSION['user_type'] == 'admin' || ($_SESSION['user_type'] == 'tech' && ($task->getTech()->getMail() == $_SESSION['mail'] || $task->getTechId() == null))){
		?>
			

			<tr>
				<td>
					<a href="../showTask/<?=$task->getId();?>"><?=$task->getName();?></a>
				</td>
				<td>
					<a href="../showClient/<?=$task->getClientId()?>" target="_blank"><?=$task->getClient()->getName();?></a>
				</td>
				<td>
					<a href="../showTech/<?=$task->getTechId()?>" target="_blank"><?=$task->getTech()->getName();?>
				</td>
				<td>
					<?=$task->getStatusText(); ?>
				</td>
			</tr>
		<?php } endforeach;?>
	</tbody>
</table>
<br>
<a href="../profile/">Volver al perfil</a>
<h1>Lista de tareas</h1>
<form method="POST">
	Filtrar por cliente: 
	<select name="client_id" >
		<option value="">No filtrar</option>
		<option value="-1">Sin cliente</option>
		<?php foreach($clients as $client): ?>
			<option value="<?=$client->getId();?>"
			<?php echo $client->getId() == $client_id ? "selected = 'selected'" : "";
				?>
			><?=$client->getName();?></option>
		<?php endforeach;?>
	</select>
	Filtrar por técnico: 
	<select name="tech_id">
		<option value="">No filtrar</option>
		<option value="-1">Sin técnico</option>
		<?php foreach($techs as $tech): ?>
			<option value="<?=$tech->getId();?>" <?php echo $tech->getId() == $tech_id ? "selected = 'selected'" : "";
				?>><?=$tech->getName();?>
			
			</option>
		 <?php endforeach;?>
	</select>
	Filtrar por estado: 
	<select name="status_id">
		<option value = "" <?php if($status_id == null) echo "selected=''" ?>>No filtrar</option>
		<option value = '0' <?php if($status_id == 0 && $status_id != null) echo "selected=''" ?>>Por empezar</option>
		<option value = '1' <?php if($status_id == 1) echo "selected=''" ?>>Haciéndose</option>
		<option value = '2' <?php if($status_id == 2) echo "selected=''" ?>>Terminada</option>
	</select>
	<input type="submit" value="Filtrar">
	<input type="submit" name="reset" value="Eliminar filtros">
</form>
<br>
<?php if ($tasks == null){
	echo "No hay tareas que mostrar";
}
else{ ?>
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
		<?php  endforeach;?>
	</tbody>
</table>
<?php } ?>
<br>
<a href="../profile/">Volver al perfil</a>
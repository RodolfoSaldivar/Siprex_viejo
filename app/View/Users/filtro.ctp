


<tbody id="filtro_cambiar">
	<?php foreach ($usuarios as $key => $usuario): ?>
		<tr>
			<td>
				<div class="border_top"></div>
				<?php echo $usuario['User']['tipo_user'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<?php echo $usuario[0]['nombre'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<?php echo $usuario['User']['username'] ?>
			</td>
			<td>
				<a href="/users/edit/<?php echo $usuario['User']['id'] ?>">
					<i class="material-icons">edit</i>
				</a>
			</td>
		</tr>
	<?php endforeach ?>
</tbody>
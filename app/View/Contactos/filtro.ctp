


<tbody id="filtro_cambiar">
	<?php foreach ($contactos as $key => $contacto): ?>
		<tr>
			<?php if ($this->Session->read("Auth.User.tipo_user") == "SA"): ?>
				<td>
					<div class="border_top"></div>
					<?php echo $contacto['Contacto']['id_original'] ?>
				</td>
			<?php endif ?>
			<td>
				<div class="border_top"></div>
				<?php echo $contacto['Contacto']['tipo_contacto'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<?php echo $contacto['Contacto']['nombre'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<?php echo $contacto['Contacto']['puesto'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<?php echo $contacto['Contacto']['rfc'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<?php echo $contacto['Contacto']['correo'] ?>
			</td>
			<td>
				<a href="/contactos/view/<?php echo $contacto['Contacto']['id'] ?>">
					<i class="material-icons">visibility</i>
				</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="/contactos/edit/<?php echo $contacto['Contacto']['id'] ?>">
					<i class="material-icons">edit</i>
				</a>
			</td>
		</tr>
	<?php endforeach ?>
</tbody>


<div class="row margin_nada">
	<div class="col s12 m6">
		<h4>
			CONTACTOS
			<a href="/contactos/add" class="btn-floating btn-large waves-effect waves-light">
				<i class="material-icons">add</i>
			</a>
		</h4>
	</div>

	<div class="col s12 m6">
		<?php include 'buscador.ctp';?>
	</div>
</div>

<table class="">
	<thead>
		<tr>
			<?php if ($this->Session->read("Auth.User.tipo_user") == "SA"): ?>
				<th>ID</th>
			<?php endif ?>
			<th>TIPO DE CONTACTO</th>
			<th>NOMBRE</th>
			<th>PUESTO</th>
			<th>RFC</th>
			<th>CORREO</th>
		</tr>
	</thead>

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
</table>

<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$("#opcion_proveedores").addClass("opcion_seleccionada");

<?php $this->Html->scriptEnd(); ?>
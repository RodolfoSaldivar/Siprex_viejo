

<div class="row valign-wrapper margin_nada">
	<div class="col s12 m5 l6">
		<h4>
			EMPRESAS
			<a href="/empresas/add" class="btn-floating btn-large waves-effect waves-light">
				<i class="material-icons">add</i>
			</a>
		</h4>
	</div>

	<div class="col s12 m6 valign">
		<a class="btn waves-effect waves-black" href="/empresas/seleccionar">
			Cambiar Empresa
		</a>
	</div>
</div>

<div class="row">
<table class="col s12 l10">
	<thead>
		<tr>
			<th>NOMBRE</th>
			<th>MAX USUARIOS</th>
			<th>FECHA CORTE</th>
			<th></th>
			<th>ACTIVO</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($empresas as $key => $empresa): ?>
			<tr>
				<td>
					<div class="border_top"></div>
					<?php if ($empresa['Empresa']['id'] == $mi_empresa): ?>
						<b class="left"><?php echo $empresa['Empresa']['nombre'] ?></b>
						&nbsp;&nbsp;&nbsp;
						<i class="material-icons red-text">arrow_back</i>
						<i class="material-icons red-text">arrow_back</i>
					<?php else: ?>
						<?php echo $empresa['Empresa']['nombre'] ?>
					<?php endif ?>
				</td>
				<td>
					<div class="border_top"></div>
					<?php echo $empresa["Empresa"]["usuarios"] ?>
				</td>
				<td>
					<div class="border_top"></div>
					<?php echo $empresa["Empresa"]["fecha_corte"] ?>
				</td>
				<td width="200">
					<a class="btn waves-effect waves-black" href="/empresas/seleccionar/<?php echo $empresa['Empresa']['id'] ?>">
						Escoger
					</a>
				</td>
				<td width="175">
					<div class="switch" id="cambiame_<?php echo $empresa["Empresa"]["id"] ?>">
						<label>
							No
							<input
								<?php if ($empresa["Empresa"]["activo"] == 1) echo "checked"; ?>
								id="activo_<?php echo $empresa["Empresa"]["id"] ?>"
								value="<?php echo $empresa["Empresa"]["activo"] ?>"
								type="checkbox"
							>
							<span class="lever"></span>
							Si
						</label>
					</div>
				</td>
				<td>
					<a href="/empresas/edit/<?php echo $empresa['Empresa']['id'] ?>">
						<i class="material-icons">edit</i>
					</a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="pointer" onclick='seguroBorrar("<?php echo $empresa['Empresa']['id'] ?>")'>
						<i class="material-icons">delete</i>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
</div>

<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$("#opcion_empresas").addClass("opcion_seleccionada");

	function seguroBorrar(empresa_id)
	{
		Materialize.toast(
			'<div>Se eliminará TODO, ¿Seguro?</div><a href="/empresas/delete/'+empresa_id+'" class="waves-effect waves-light btn white"><i class="material-icons blanco">done</i></a>',
			3000
		);
	}


	<?php foreach ($empresas as $key => $empresa): ?>
			
		$(document).on("change", "#activo_<?php echo $empresa["Empresa"]["id"] ?>", function()
		{
			ajax<?php echo $empresa["Empresa"]["id"] ?>();
		});

		function ajax<?php echo $empresa["Empresa"]["id"] ?>()
		{
			$.ajax({
		        type:'POST',
		        cache: false,
		        url: '<?= Router::Url(['controller' => 'Empresas', 'action' => 'activo_actualizar']); ?>',
		        success: function(response)
		        {
		            $('#cambiame_<?php echo $empresa["Empresa"]["id"] ?>').replaceWith(response);
		        },
		        data: {
		        	id: '<?php echo $empresa["Empresa"]["id"] ?>',
		        	activo: $('#activo_<?php echo $empresa["Empresa"]["id"] ?>').val()
		        }
		    });
		}

	<?php endforeach ?>	

<?php $this->Html->scriptEnd(); ?>
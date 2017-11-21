

<div class="row margin_nada">
	<div class="col s12 m6">
		<h4>
			USUARIOS
			<a href="/users/add" class="btn-floating btn-large waves-effect waves-light">
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
			<th>TIPO DE USUARIO</th>
			<th>NOMBRE</th>
			<th>USERNAME</th>
			<th class="center">ACTIVO</th>
		</tr>
	</thead>

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
				<td class="center" id="poner_switch_<?php echo $usuario["User"]["id"] ?>">
					<div class="switch">
						<label>
							<input <?php if ($usuario["User"]["activo"] == 1) echo "checked"; ?> type="checkbox" id='usuario_<?php echo $usuario["User"]["id"] ?>' value='<?php echo $usuario["User"]["activo"] ?>' onchange="activarDesactivar('<?php echo $usuario["User"]["id"] ?>')">
							<span class="lever"></span>
						</label>
					</div>
				</td>
				<td>
					<a href="/users/edit/<?php echo $usuario['User']['id'] ?>">
						<i class="material-icons">edit</i>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>


<?php $this->Html->scriptStart(array('inline' => false)); ?>

	function activarDesactivar(usuario_id)
	{
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '/users/activar_desactivar',
	        success: function(response)
	        {
	            $('#poner_switch_'+usuario_id).children().replaceWith(response);
	        },
	        data: {
	        	usuario_id: usuario_id,
	        	activo: $('#usuario_'+usuario_id).val()
	        }
	    });
	}

<?php $this->Html->scriptEnd(); ?>
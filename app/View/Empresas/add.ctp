

<h3>AGREGAR EMPRESA</h3>
<br><br>

<?php echo $this->Form->create(); ?>

	<div class="row">
		
		<div id="padding_right" class="col m6">

			<div class="input-field">
				<input id="nombre" type="text" name="data[Empresa][nombre]">
				<label for="nombre">
					NOMBRE
					<label id="nombre-error" class="error validation_label" for="nombre"></label>
				</label>
			</div>

		</div>
		
		<div id="padding_left" class="col m6">

			<div class="input-field">
				<input id="mail" type="text" name="data[Empresa][mail]">
				<label for="mail">
					MAIL
					<label id="mail-error" class="error validation_label" for="mail"></label>
				</label>
			</div>

		</div>

	</div>

	<div class="row">
		
		<div id="padding_right" class="col m6">

			<div class="input-field">
				<input id="usuarios" type="number" name="data[Empresa][usuarios]" step="1">
				<label for="usuarios">
					MAX USUARIOS
					<label id="usuarios-error" class="error validation_label" for="usuarios"></label>
				</label>
			</div>

		</div>
		
		<div id="padding_left" class="col m6">

			<div class="input-field">
				<input id="fecha_corte" class="datepicker" type="date" name="data[Empresa][fecha_corte]">
				<label for="fecha_corte">
					FECHA CORTE
					<label id="fecha_corte-error" class="error validation_label" for="fecha_corte"></label>
				</label>
			</div>

		</div>

	</div>

	<div class="row">
		<div class="col s12">
			<button class="right btn waves-effect waves-black" type="submit" name="action">
				Agregar Empresa
			</button>
		</div>
	</div>



<?php echo $this->Form->end(); ?>



<?php $this->Html->script('pickadate_default', array('inline' => false)); ?>

<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$('#EmpresaAddForm').validate({
		rules: {
			'data[Empresa][nombre]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[Empresa][mail]': {
				required: true,
				alphanumeric: true,
				email: true,
				maxlength: 50
			},
			'data[Empresa][usuarios]': {
				required: true,
				alphanumeric: true,
				min: 0
			},
			'data[Empresa][fecha_corte]': {
				required: true
			}
		}
	});

	$('.datepicker').pickadate({

	});

<?php $this->Html->scriptEnd(); ?>
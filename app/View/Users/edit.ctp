

<h3>Editar Usuario</h3>
<br><br>

<?php echo $this->Form->create(); ?>

	<?php echo $this->Form->hidden('id', array('value' => $this->request->data["User"]['id'])); ?>

	<div class="row">
		
		<div id="padding_right" class="col m6 s12">
			
			<div class="input-field">
				<input id="nombre" type="text" name="data[User][nombre]" value="<?php echo @$this->request->data["User"]["nombre"] ?>">
				<label for="nombre">
					NOMBRE
					<label id="nombre-error" class="error validation_label" for="nombre"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="a_paterno" type="text" name="data[User][a_paterno]" value="<?php echo @$this->request->data["User"]["a_paterno"] ?>">
				<label for="a_paterno">
					APELLIDO PATERNO
					<label id="a_paterno-error" class="error validation_label" for="a_paterno"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="a_materno" type="text" name="data[User][a_materno]" value="<?php echo @$this->request->data["User"]["a_materno"] ?>">
				<label for="a_materno">
					APELLIDO MATERNO
					<label id="a_materno-error" class="error validation_label" for="a_materno"></label>
				</label>
			</div>
			
		</div>

		<div id="padding_left" class="col m6 s12">

			<div class="input-field">
				<select name="data[User][tipo_user]" id="tipo_user">
					<option
						<?php if ($this->request->data["User"]["tipo_user"] == "Admin") echo "selected"; ?> value="Admin">Admin</option>
					<option
						<?php if ($this->request->data["User"]["tipo_user"] == "Usuario") echo "selected"; ?> value="Usuario">Usuario</option>
				</select>
				<label>
					TIPO DE USUARIO
				</label>
			</div>
			
			<div class="input-field">
				<input id="username" type="text" name="data[User][username]" value="<?php echo @$this->request->data["User"]["username"] ?>">
				<label for="username">
					USERNAME
					<label id="username-error" class="error validation_label" for="username"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="password" type="text" name="data[User][password]" value="<?php echo @$this->request->data["User"]["password"] ?>">
				<label for="password">
					CONTRASEÑA
					<label id="password-error" class="error validation_label" for="password"></label>
				</label>
			</div>

			<div class="col m12">
				<button class="right btn waves-effect waves-black" type="submit" name="action">
					Editar Usuario
				</button>
			</div>

		</div>

	</div>



<?php echo $this->Form->end(); ?>



<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$(document).ready(function() {
		$('select').material_select();
	});



	$('#UserEditForm').submit(function()
	{
		if($('#tipo_user option:selected').val() == "nada")
		{
			$("#tipo_user-error").css("display", "initial");
			event.preventDefault();
		}
			
	});

	$(document).on("change", "#tipo_user", function()
	{
		$("#tipo_user-error").css("display", "none");
	});



	$('#UserEditForm').validate({
		rules: {
			'data[User][nombre]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[User][a_paterno]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[User][a_materno]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[User][username]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[User][password]': {
				required: true,
				alphanumeric: true,
				maxlength: 145
			}
		}
	});

<?php $this->Html->scriptEnd(); ?>
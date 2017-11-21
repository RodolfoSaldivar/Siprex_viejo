

<h3>REGISTRO</h3>
<br><br>

<?php echo $this->Form->create(); ?>

	<div class="row margin_nada">
		
		<div id="padding_right" class="col m6">

			<div class="input-field">
				<input id="nombre_e" type="text" name="data[Empresa][nombre]" value="<?php echo @$this->request->data["Empresa"]["nombre"] ?>">
				<label for="nombre_e">
					NOMBRE DE EMPRESA
					<label id="nombre_e-error" class="error validation_label" for="nombre_e"></label>
				</label>
			</div>

		</div>
		
		<div id="padding_left" class="col m6">

			<div class="input-field">
				<input id="mail" type="text" name="data[Empresa][mail]" value="<?php echo @$this->request->data["Empresa"]["mail"] ?>">
				<label for="mail">
					MAIL DE CONTACTO
					<label id="mail-error" class="error validation_label" for="mail"></label>
				</label>
			</div>

		</div>

	</div>

	<div class="row">
		
		<div id="padding_right" class="col m6 s12">
			
			<div class="input-field">
				<input id="nombre_u" type="text" name="data[User][nombre]" value="<?php echo @$this->request->data["User"]["nombre"] ?>">
				<label for="nombre_u">
					NOMBRE DE USUARIO
					<label id="nombre_u-error" class="error validation_label" for="nombre_u"></label>
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
				<input readonly="" id="tipo_user" type="text" name="data[User][tipo_user]" value="Admin">
				<label for="tipo_user">
					TIPO DE USUARIO
					<label id="tipo_user-error" class="error validation_label" for="tipo_user"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="username" type="text" name="data[User][username]">
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
					Terminar
				</button>
			</div>

		</div>

	</div>



<?php echo $this->Form->end(); ?>



<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$('#UserRegistroForm').validate({
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
				maxlength: 45
			},
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
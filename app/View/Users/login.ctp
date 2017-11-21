

<?php $this->assign('title', 'Iniciar Sesión');  ?>


		
<?php echo $this->Form->create() ?>

	<div class="row">	
		<div class="input-field col l8 offset-l2 m10 offset-m1 s12">
			<input placeholder="Nombre de usuario" name="data[User][username]" type="text" id="UserUsername" class="error">
			<label for="UserUsername">
				Usuario
				<label id="UserUsername-error" class="error validation_label" for="UserUsername"></label>
			</label>
		</div>
	</div>

	<div class="row">
		<div class="input-field col l8 offset-l2 m10 offset-m1 s12">
			<input placeholder="Ingresar contraseña" name="data[User][password]" type="password" id="UserPassword" aria-required="true" class="error" aria-invalid="true">
			<label for="UserPassword">
				Contraseña
				<label id="UserPassword-error" class="error validation_label" for="UserPassword"></label>
			</label>
		</div>
	</div>

	<div class="row">
		<div class="center">
			<button class="btn waves-effect waves-black" type="submit" name="action">
				Iniciar Sesión
			</button>
		</div>
	</div>

	<br><br>
	<div class="row">
		<div class="center">
			<a href="/users/registro" class="waves-effect waves-light btn">Registrate</a>
		</div>
	</div>

<?php echo $this->Form->end(); ?>



<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$.validator.messages.required = '*Requerido';
	$.validator.messages.alphanumeric = '*Solo letras y números';

	$('#UserLoginForm').validate({
		rules: {
			'data[User][username]': {
				required: true,
				alphanumeric: true
			},
			'data[User][password]': {
				required: true,
				alphanumeric: true
			}
		}
	});

<?php $this->Html->scriptEnd(); ?>
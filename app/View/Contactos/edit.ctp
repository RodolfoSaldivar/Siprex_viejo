

<h4>EDITAR CONTACTO</h4>
<br><br>

<?php echo $this->Form->create(); ?>

	<?php echo $this->Form->hidden('id', array('value' => $contacto['id'])); ?>	

	<div class="row">
		
		<div id="padding_right" class="col m6">

			<div class="input-field">
				<select name="data[Contacto][tipo_contacto]" id="tipo_contacto">
					<option
						<?php if ($contacto['tipo_contacto'] == "Clientes") echo "selected"; ?> value="Cliente">Cliente</option>
					<option
						<?php if ($contacto['tipo_contacto'] == "Proveedor") echo "selected"; ?> value="Proveedor">Proveedor</option>
				</select>
				<label>TIPO DE CONTACTO</label>
			</div>
			
			<div class="input-field">
				<input id="nombre" type="text" name="data[Contacto][nombre]" value="<?php echo $contacto["nombre"] ?>">
				<label for="nombre">
					NOMBRE
					<label id="nombre-error" class="error validation_label" for="nombre"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="puesto" type="text" name="data[Contacto][puesto]" value="<?php echo $contacto["puesto"] ?>">
				<label for="puesto">
					PUESTO
					<label id="puesto-error" class="error validation_label" for="puesto"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="rfc" type="text" name="data[Contacto][rfc]" value="<?php echo $contacto["rfc"] ?>">
				<label for="rfc">
					RFC
					<label id="rfc-error" class="error validation_label" for="rfc"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="razon_social" type="text" name="data[Contacto][razon_social]" value="<?php echo $contacto["razon_social"] ?>">
				<label for="razon_social">
					RAZÓN SOCIAL
					<label id="razon_social-error" class="error validation_label" for="razon_social"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="correo" type="text" name="data[Contacto][correo]" value="<?php echo $contacto["correo"] ?>">
				<label for="correo">
					CORREO
					<label id="correo-error" class="error validation_label" for="correo"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="telefono" type="text" name="data[Contacto][telefono]" value="<?php echo $contacto["telefono"] ?>">
				<label for="telefono">
					TELÉFONO
					<label id="telefono-error" class="error validation_label" for="telefono"></label>
				</label>
			</div>

		</div>

		<div id="padding_left" class="col s6">
			
			<div class="input-field">
				<input id="calle" type="text" name="data[Contacto][calle]" value="<?php echo $contacto["calle"] ?>">
				<label for="calle">
					CALLE
					<label id="calle-error" class="error validation_label" for="calle"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="colonia" type="text" name="data[Contacto][colonia]" value="<?php echo $contacto["colonia"] ?>">
				<label for="colonia">
					COLONIA
					<label id="colonia-error" class="error validation_label" for="colonia"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="municipio" type="text" name="data[Contacto][municipio]" value="<?php echo $contacto["municipio"] ?>">
				<label for="municipio">
					MUNICIPIO
					<label id="municipio-error" class="error validation_label" for="municipio"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="estado" type="text" name="data[Contacto][estado]" value="<?php echo $contacto["estado"] ?>">
				<label for="estado">
					ESTADO
					<label id="estado-error" class="error validation_label" for="estado"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="codigo_postal" type="text" name="data[Contacto][codigo_postal]" value="<?php echo $contacto["codigo_postal"] ?>">
				<label for="codigo_postal">
					CÓDIGO POSTAL
					<label id="codigo_postal-error" class="error validation_label" for="codigo_postal"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="pais" type="text" name="data[Contacto][pais]" value="<?php echo $contacto["pais"] ?>">
				<label for="pais">
					PAÍS
					<label id="pais-error" class="error validation_label" for="pais"></label>
				</label>
			</div>

			<div class="col m12">
				<button class="right btn waves-effect waves-black" type="submit" name="action">
					Editar Contacto
				</button>
			</div>

		</div>

	</div>



<?php echo $this->Form->end(); ?>



<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$(document).ready(function() {
		$('select').material_select();
	});

	$("#opcion_proveedores").addClass("opcion_seleccionada");



	$('#ContactoEditForm').submit(function()
	{
		if($('#tipo_contacto option:selected').val() == "nada")
		{
			$("#tipo_contacto-error").css("display", "initial");
			event.preventDefault();
		}
			
	});

	$(document).on("change", "#tipo_contacto", function()
	{
		$("#tipo_contacto-error").css("display", "none");
	});



	$('#ContactoEditForm').validate({
		rules: {
			'data[Contacto][nombre]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[Contacto][puesto]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[Contacto][rfc]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[Contacto][razon_social]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[Contacto][correo]': {
				required: true,
				alphanumeric: true,
				maxlength: 45,
				email: true
			},
			'data[Contacto][telefono]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[Contacto][calle]': {
				required: true,
				alphanumeric: true,
				maxlength: 99
			},
			'data[Contacto][colonia]': {
				required: true,
				alphanumeric: true,
				maxlength: 99
			},
			'data[Contacto][municipio]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[Contacto][estado]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[Contacto][codigo_postal]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[Contacto][pais]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			}
		}
	});

<?php $this->Html->scriptEnd(); ?>
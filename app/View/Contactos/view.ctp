

<h4>DATOS DE CONTACTO</h4>
<br><br>

<div class="row">
	
	<div id="padding_right" class="col m6">
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["tipo_contacto"] ?>">
			<label for="nombre">
				TIPO DE CONTACTO
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["nombre"] ?>">
			<label for="nombre">
				NOMBRE
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["puesto"] ?>">
			<label for="puesto">
				PUESTO
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["rfc"] ?>">
			<label for="rfc">
				RFC
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["razon_social"] ?>">
			<label for="razon_social">
				RAZÓN SOCIAL
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["correo"] ?>">
			<label for="correo">
				CORREO
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["telefono"] ?>">
			<label for="telefono">
				TELÉFONO
			</label>
		</div>

	</div>

	<div id="padding_left" class="col s6">
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["calle"] ?>">
			<label for="calle">
				CALLE
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["colonia"] ?>">
			<label for="colonia">
				COLONIA
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["municipio"] ?>">
			<label for="municipio">
				MUNICIPIO
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["estado"] ?>">
			<label for="estado">
				ESTADO
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["codigo_postal"] ?>">
			<label for="codigo_postal">
				CÓDIGO POSTAL
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $contacto["pais"] ?>">
			<label for="pais">
				PAÍS
			</label>
		</div>

	</div>

</div>

<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$("#opcion_proveedores").addClass("opcion_seleccionada");

<?php $this->Html->scriptEnd(); ?>
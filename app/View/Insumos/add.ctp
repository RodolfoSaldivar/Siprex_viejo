

<h4>AGREGAR INSUMO</h4>
<br><br>

<?php echo $this->Form->create(); ?>

	<div class="row">
		
		<div id="padding_right" class="col s12 m6">
			
			<div class="input-field" id="cambiar_id">
				<input id="identificador" type="text" name="data[Insumo][identificador]">
				<label for="identificador">
					ID
					<label id="identificador-error" class="error validation_label" for="identificador"></label>
				</label>
			</div>

			<div class="input-field">
				<select name="data[Insumo][tipo_insumo]" id="tipo_insumo">
					<option value="nada" disabled selected></option>
					<option value="Materiales">Materiales</option>
					<option value="Herramientas">Herramientas</option>
					<option value="Equipos">Equipos</option>
					<option value="Mano de Obra">Mano de Obra</option>
					<option value="Auxiliares">Auxiliares</option>
					<option value="Otros">Otros</option>
				</select>
				<label>TIPO DE INSUMO <label id="tipo_insumo-error" class="validation_label" for="tipo_insumo">*Requerido</label></label>
			</div>

			<div class="input-field">
				<select name="data[Insumo][referencia]" id="referencia">
					<option value="nada" disabled selected></option>
					<option value="Aceros">Aceros</option>
					<option value="Adhesivos y Boquillas">Adhesivos y Boquillas</option>
					<option value="Aditivos">Aditivos</option>
					<option value="Agregados">Agregados</option>
					<option value="Blocks y Tabiques">Blocks y Tabiques</option>
					<option value="Básicos">Básicos</option>
					<option value="Cementos y Morteros">Cementos y Morteros</option>
					<option value="Concretos Prefabricados">Concretos Prefabricados</option>
					<option value="Equipo y Maquinaria">Equipo y Maquinaria</option>
					<option value="Herrería">Herrería</option>
					<option value="Instalaciones Eléctricas">Instalaciones Eléctricas</option>
					<option value="Instalaciones Hidráulicas">Instalaciones Hidráulicas</option>
					<option value="Instalaciones Sanitarias">Instalaciones Sanitarias</option>
					<option value="Limpieza">Limpieza</option>
					<option value="Mano de Obra">Mano de Obra</option>
					<option value="Maderas">Maderas</option>
					<option value="Muros y Plafones Falsos">Muros y Plafones Falsos</option>
					<option value="Pinturas e Impermiabilizantes">Pinturas e Impermiabilizantes</option>
					<option value="Pisos y Azulejos">Pisos y Azulejos</option>
					<option value="Sub-Contratos">Sub-Contratos</option>
					<option value="Tuberías Tuboplus">Tuberías Tuboplus</option>
					<option value="Tuberías de Cobre">Tuberías de Cobre</option>
					<option value="Tuberías de PVC">Tuberías de PVC</option>
					<option value="Vidrio y Aluminio">Vidrio y Aluminio</option>
					<option value="Otros">Otros</option>
				</select>
				<label>FAMILIA <label id="referencia-error" class="validation_label" for="referencia">*Requerido</label></label>
			</div>

			<div class="input-field">
				<select name="data[Insumo][contacto_id]" id="contacto_id">
					<option value="nada" disabled selected></option>
					<option value="agregar_contacto">Crear Contacto</option>
					<hr>
					<?php foreach ($contactos as $key => $contacto): ?>
						<option value="<?php echo $key ?>"><?php echo $contacto ?></option>
					<?php endforeach ?>
				</select>
				<label>CONTACTO <label id="contacto_id-error" class="validation_label" for="contacto_id">*Requerido</label></label>
			</div>
			
			<div class="input-field">
				<input id="marca" type="text" name="data[Insumo][marca]">
				<label for="marca">
					MARCA
					<label id="marca-error" class="error validation_label" for="marca"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="modelo" type="text" name="data[Insumo][modelo]">
				<label for="modelo">
					MODELO
					<label id="modelo-error" class="error validation_label" for="modelo"></label>
				</label>
			</div>

		</div>

		<div id="padding_left" class="col s12 m6">
			
			<div class="input-field">
				<input id="cantidad" type="number" name="data[Insumo][cantidad]">
				<label for="cantidad">
					CANTIDAD
					<label id="cantidad-error" class="error validation_label" for="cantidad"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="unidad" type="text" name="data[Insumo][unidad]">
				<label for="unidad">
					UNIDAD
					<label id="unidad-error" class="error validation_label" for="unidad"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="precio_compra" type="number" name="data[Insumo][precio_compra]">
				<label for="precio_compra">
					PRECIO COMPRA
					<label id="precio_compra-error" class="error validation_label" for="precio_compra"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="precio_venta" type="number" name="data[Insumo][precio_venta]">
				<label for="precio_venta">
					PRECIO VENTA
					<label id="precio_venta-error" class="error validation_label" for="precio_venta"></label>
				</label>
			</div>

			<div class="input-field">
				<textarea id="descripcion" class="materialize-textarea" name="data[Insumo][descripcion]"></textarea>
				<label for="descripcion" class="textarea_label">
					DESCRIPCIÓN
					<label id="descripcion-error" class="error validation_label" for="descripcion"></label>
				</label>
			</div>

			<div class="col m12">
				<button class="right btn waves-effect waves-black" type="submit" name="action">
					Agregar Insumo
				</button>
			</div>

		</div>

	</div>



<?php echo $this->Form->end(); ?>


<?php $this->Html->script('donetyping', array('inline' => false)); ?>

<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$(document).ready(function() {
		$('select').material_select();
	});


	$("#opcion_insumos").addClass("opcion_seleccionada");



	$('#InsumoAddForm').submit(function()
	{
		if($('#tipo_insumo option:selected').val() == "nada")
		{
			$("#tipo_insumo-error").css("display", "initial");
			event.preventDefault();
		}

		if($('#referencia option:selected').val() == "nada")
		{
			$("#referencia-error").css("display", "initial");
			event.preventDefault();
		}
	});

	$(document).on("change", "#tipo_insumo", function()
	{
		$("#tipo_insumo-error").css("display", "none");
	});

	$(document).on("change", "#referencia", function()
	{
		$("#referencia-error").css("display", "none");
	});

	$(document).on("change", "#contacto_id", function()
	{
		$("#contacto_id-error").css("display", "none");

		if($('#contacto_id option:selected').val() == "agregar_contacto")
		{
			url = '<?= Router::Url(['controller' => 'contactos', 'action' => 'add']); ?>';
     		$(location).attr("href", url);
		}
	});


	$(document).on("change", "#precio_compra", function()
	{
		var minimo = $("#precio_compra").val();
		$("input[name='data[Insumo][precio_venta]'").rules('remove', 'min');
		$("input[name='data[Insumo][precio_venta]'").rules('add', {min: minimo});
	});
		

	$('#InsumoAddForm').validate({
		rules: {
			'data[Insumo][identificador]': {
				required: true,
				alphanumeric: true,
				maxlength: 50
			},
			'data[Insumo][descripcion]': {
				required: true,
				alphanumeric: true,
				maxlength: 500
			},
			'data[Insumo][referencia]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[Insumo][marca]': {
				alphanumeric: true,
				maxlength: 45
			},
			'data[Insumo][modelo]': {
				alphanumeric: true,
				maxlength: 45
			},
			'data[Insumo][cantidad]': {
				required: true,
				alphanumeric: true,
				min: 0
			},
			'data[Insumo][unidad]': {
				required: true,
				alphanumeric: true,
				maxlength: 45
			},
			'data[Insumo][precio_compra]': {
				required: true,
				alphanumeric: true,
				min: 0
			},
			'data[Insumo][precio_venta]': {
				required: true,
				alphanumeric: true,
				min: 0
			}
		}
	});

	$('#identificador').donetyping(function()
	{ revisarIdentificador(); });

	function revisarIdentificador()
	{
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '<?= Router::Url(['controller' => 'Insumos', 'action' => 'revisar_identificador']); ?>',
	        success: function(response)
	        {
	            $('#cambiar_id').replaceWith(response);

	            var poner_focus = $("#identificador");
				var length_texto = poner_focus.val().length;
				poner_focus.focus();
				poner_focus[0].setSelectionRange(length_texto, length_texto);

	            $('#identificador').donetyping(function()
				{ revisarIdentificador(); });
	        },
	        data: {
	        	nuevo_id: $('#identificador').val()
	        }
	    });
	}

<?php $this->Html->scriptEnd(); ?>
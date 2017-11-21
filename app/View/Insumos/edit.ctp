

<h4>EDITAR INSUMO</h4>
<br><br>

<?php echo $this->Form->create(); ?>

	<?php echo $this->Form->hidden('id', array('value' => $insumo['id'])); ?>

	<div class="row">
		
		<div id="padding_right" class="col m6 s12">
			
			<div class="input-field" id="cambiar_id">
				<input id="identificador" type="text" name="data[Insumo][identificador]" value="<?php echo $insumo["identificador"] ?>">
				<label for="identificador">
					ID
					<label id="identificador-error" class="error validation_label" for="identificador"></label>
				</label>
			</div>

			<div class="input-field">
				<select name="data[Insumo][tipo_insumo]" value="<?php echo $insumo['tipo_insumo'] ?>">
					<option
						<?php if ($insumo['tipo_insumo'] == "Materiales") echo "selected"; ?>
						value="Materiales">Materiales</option>
					<option
						<?php if ($insumo['tipo_insumo'] == "Herramientas") echo "selected"; ?>
						value="Herramientas">Herramientas</option>
					<option
						<?php if ($insumo['tipo_insumo'] == "Equipos") echo "selected"; ?>
						value="Equipos">Equipos</option>
					<option
						<?php if ($insumo['tipo_insumo'] == "Mano de Obra") echo "selected"; ?>
						value="Mano de Obra">Mano de Obra</option>
					<option
						<?php if ($insumo['tipo_insumo'] == "Auxiliares") echo "selected"; ?>
						value="Auxiliares">Auxiliares</option>
					<option
						<?php if ($insumo['tipo_insumo'] == "Otros") echo "selected"; ?>
						value="Otros">Otros</option>
				</select>
				<label>TIPO DE INSUMO</label>
			</div>

			<div class="input-field">
				<select name="data[Insumo][referencia]">
					<option
						<?php if ($insumo['referencia'] == "Aceros") echo "selected"; ?>
						value="Aceros">Aceros</option>
					<option
						<?php if ($insumo['referencia'] == "Adhesivos y Boquillas") echo "selected"; ?>
						value="Adhesivos y Boquillas">Adhesivos y Boquillas</option>
					<option
						<?php if ($insumo['referencia'] == "Aditivos") echo "selected"; ?>
						value="Aditivos">Aditivos</option>
					<option
						<?php if ($insumo['referencia'] == "Agregados") echo "selected"; ?>
						value="Agregados">Agregados</option>
					<option
						<?php if ($insumo['referencia'] == "Blocks y Tabiques") echo "selected"; ?>
						value="Blocks y Tabiques">Blocks y Tabiques</option>
					<option
						<?php if ($insumo['referencia'] == "Básicos") echo "selected"; ?>
						value="Básicos">Básicos</option>
					<option
						<?php if ($insumo['referencia'] == "Cementos y Morteros") echo "selected"; ?>
						value="Cementos y Morteros">Cementos y Morteros</option>
					<option
						<?php if ($insumo['referencia'] == "Concretos Prefabricados") echo "selected"; ?>
						value="Concretos Prefabricados">Concretos Prefabricados</option>
					<option
						<?php if ($insumo['referencia'] == "Equipo y Maquinaria") echo "selected"; ?>
						value="Equipo y Maquinaria">Equipo y Maquinaria</option>
					<option
						<?php if ($insumo['referencia'] == "Herrería") echo "selected"; ?>
						value="Herrería">Herrería</option>
					<option
						<?php if ($insumo['referencia'] == "Instalaciones Eléctricas") echo "selected"; ?>
						value="Instalaciones Eléctricas">Instalaciones Eléctricas</option>
					<option
						<?php if ($insumo['referencia'] == "Instalaciones Hidráulicas") echo "selected"; ?>
						value="Instalaciones Hidráulicas">Instalaciones Hidráulicas</option>
					<option
						<?php if ($insumo['referencia'] == "Instalaciones Sanitarias") echo "selected"; ?>
						value="Instalaciones Sanitarias">Instalaciones Sanitarias</option>
					<option
						<?php if ($insumo['referencia'] == "Limpieza") echo "selected"; ?>
						value="Limpieza">Limpieza</option>
					<option
						<?php if ($insumo['referencia'] == "Maderas") echo "selected"; ?>
						value="Maderas">Maderas</option>
					<option
						<?php if ($insumo['referencia'] == "Mano de Obra") echo "selected"; ?>
						value="Mano de Obra">Mano de Obra</option>
					<option
						<?php if ($insumo['referencia'] == "Muros y Plafones Falsos") echo "selected"; ?>
						value="Muros y Plafones Falsos">Muros y Plafones Falsos</option>
					<option
						<?php if ($insumo['referencia'] == "Pinturas e Impermiabilizantes") echo "selected"; ?>
						value="Pinturas e Impermiabilizantes">Pinturas e Impermiabilizantes</option>
					<option
						<?php if ($insumo['referencia'] == "Pisos y Azulejos") echo "selected"; ?>
						value="Pisos y Azulejos">Pisos y Azulejos</option>
					<option
						<?php if ($insumo['referencia'] == "Sub-Contratos") echo "selected"; ?>
						value="Sub-Contratos">Sub-Contratos</option>
					<option
						<?php if ($insumo['referencia'] == "Tuberías Tuboplus") echo "selected"; ?>
						value="Tuberías Tuboplus">Tuberías Tuboplus</option>
					<option
						<?php if ($insumo['referencia'] == "Tuberías de Cobre") echo "selected"; ?>
						value="Tuberías de Cobre">Tuberías de Cobre</option>
					<option
						<?php if ($insumo['referencia'] == "Tuberías de PVC") echo "selected"; ?>
						value="Tuberías de PVC">Tuberías de PVC</option>
					<option
						<?php if ($insumo['referencia'] == "Vidrio y Aluminio") echo "selected"; ?>
						value="Vidrio y Aluminio">Vidrio y Aluminio</option>
					<option
						<?php if ($insumo['referencia'] == "Otros") echo "selected"; ?>
						value="Otros">Otros</option>
				</select>
				<label>FAMILIA</label>
			</div>

			<div class="input-field">
				<select name="data[Insumo][contacto_id]">
					<?php if (empty($insumo["contacto_id"])): ?>
						<option value="nada" disabled selected></option>
						<option value="agregar_contacto">Crear Contacto</option>
						<hr>
						<?php foreach ($contactos as $key => $contacto): ?>
							<option value="<?php echo $key ?>"><?php echo $contacto ?></option>
						<?php endforeach ?>
					<?php else: ?>
						<?php foreach ($contactos as $key => $contacto): ?>
							<option
								<?php if ($insumo['contacto_id'] == $key) echo "selected"; ?> value="<?php echo $key ?>"><?php echo $contacto ?></option>
						<?php endforeach ?>
					<?php endif ?>	
				</select>
				<label>CONTACTO</label>
			</div>
			
			<div class="input-field">
				<input id="marca" type="text" name="data[Insumo][marca]" value="<?php echo $insumo["marca"] ?>">
				<label for="marca">
					MARCA
					<label id="marca-error" class="error validation_label" for="marca"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="modelo" type="text" name="data[Insumo][modelo]" value="<?php echo $insumo["modelo"] ?>">
				<label for="modelo">
					MODELO
					<label id="modelo-error" class="error validation_label" for="modelo"></label>
				</label>
			</div>

		</div>

		<div id="padding_left" class="col m6 s12">
			
			<div class="input-field">
				<input id="cantidad" type="number" name="data[Insumo][cantidad]" value="<?php echo $insumo["cantidad"] ?>">
				<label for="cantidad">
					CANTIDAD
					<label id="cantidad-error" class="error validation_label" for="cantidad"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="unidad" type="text" name="data[Insumo][unidad]" value="<?php echo $insumo["unidad"] ?>">
				<label for="unidad">
					UNIDAD
					<label id="unidad-error" class="error validation_label" for="unidad"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="precio_compra" type="number" name="data[Insumo][precio_compra]" value="<?php echo $insumo["precio_compra"] ?>">
				<label for="precio_compra">
					PRECIO COMPRA
					<label id="precio_compra-error" class="error validation_label" for="precio_compra"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="precio_venta" type="number" name="data[Insumo][precio_venta]" value="<?php echo $insumo["precio_venta"] ?>">
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
					Editar Insumo
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

	$('#descripcion').val("<?php echo $insumo['descripcion'] ?>");
  	$('#descripcion').trigger('autoresize');



	$('#InsumoEditForm').submit(function()
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

		if($('#contacto_id option:selected').val() == "nada")
		{
			$("#contacto_id-error").css("display", "initial");
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
	});


	$(document).on("change", "#precio_compra", function()
	{
		minimo = $("#precio_compra").val();
		$("input[name='data[Insumo][precio_venta]'").rules('remove', 'min');
		$("input[name='data[Insumo][precio_venta]'").rules('add', {min: minimo});
	});

	var minimo = <?php echo $insumo["precio_compra"] ?>;

	$('#InsumoEditForm').validate({
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
				min: minimo
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
	        	nuevo_id: $('#identificador').val(),
	        	actual_id: '<?php echo $insumo["identificador"] ?>'
	        }
	    });
	}

<?php $this->Html->scriptEnd(); ?>
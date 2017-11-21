

<h4>AGREGAR CONCEPTO</h4>
<br><br>

<?php echo $this->Form->create(); ?>

	<div class="row">

		<table class="tabla_modal">
			<thead>
				<tr>
					<th>ID</th>
					<th>PARTIDA</th>
					<th>CONCEPTO</th>
					<th>UNIDAD</th>
					<th>CANTIDAD</th>
					<th>P.U.</th>
					<th>IMPORTE</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td id="cambiar_clave">
						<div class="border_top"></div>
						<label id="clave-error" class="error validation_label" for="clave"></label>
						<input class="en_modal para_escribir campos_nuevos" id="clave" name="data[APU][clave]" type="text">
						<label for="clave">
					</td>
					<td>
						<div class="input-field">
							<label id="partida-error" class="validation_label" for="partida">*Requerido</label>
							<select name="data[ApuPartida][partida_id]" id="partida">
								<option value="nada" disabled selected></option>
								<option value="nueva_partida">Crear Nueva</option>
								<option class="divider" disabled=""></option>
								<?php foreach ($partidas as $id => $nombre): ?>
									<option value="<?php echo $id ?>"><?php echo $nombre ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</td>
					<td>
						<label id="descripcion-error" class="error validation_label" for="descripcion"></label>
						<textarea id="descripcion" class="materialize-textarea para_escribir campos_nuevos" name="data[APU][descripcion]" type="text"></textarea>
					</td>
					<td>
						<div class="border_top"></div>
						<label id="unidad-error" class="error validation_label" for="unidad"></label>
						<input class="en_modal para_escribir campos_nuevos" id="unidad" name="data[APU][unidad]" type="text">
					</td>
					<td>
						<div class="border_top"></div>
						<label id="cantidad-error" class="error validation_label" for="cantidad"></label>
						<input class="en_modal para_escribir campos_nuevos" id="cantidad" name="data[ApuPartida][cantidad]" type="number">
					</td>
					<td>
						<div class="border_top"></div>
						<input disabled="" class="en_modal right-align" value="0.00">
					</td>
					<td>
						<div class="border_top"></div>
						<input disabled="" class="en_modal right-align" id="importe" value="0.00" name="data[APU][importe]">
					</td>
				</tr>
			</tbody>
		</table>
		

		<div class="col m12">
			<button class="right btn waves-effect waves-black" type="submit" name="action" value="analizar">
				Analizar
			</button>
			<button class="right btn waves-effect waves-black" type="submit" name="action" value="guardar" style="margin-right: 10px;">
				Guardar
			</button>
		</div>

		<br><br><br><br>

	</div>

<?php echo $this->Form->end(); ?>



<div id="modal_agregar_partida" class="modal">
	<form id="PartidaAgregarForm" action="/partidas/modal_agregar" method="post" accept-charset="utf-8">
		<input type="hidden" name="data[url]" value="/analisis_precios_us/add">
		<div class="modal-content">
			<div class="row margin_nada">
				<br><br>
				<div id="cambiar_identificador" class="input-field col s12 m6">
					<input id="identificador" name="data[Partida][identificador]" type="text" placeholder="Ej 1.00">
					<label for="identificador">
						ID PARTIDA
						<label id="identificador-error" class="error validation_label" for="identificador"></label>
					</label>
				</div>
				<div class="input-field col s12 m6">
					<input id="nombre" name="data[Partida][nombre]" type="text">
					<label for="nombre">
						NOMBRE
						<label id="nombre-error" class="error validation_label" for="nombre"></label>
					</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn waves-effect waves-light modal-action modal-close waves-effect waves-green">
				Cerrar
			</button>
			<button class="btn waves-effect waves-light" type="submit" name="action" style="margin-right: 10px;">
				Guardar
			</button>
		</div>
	</form>
</div>



<?php $this->Html->script('donetyping', array('inline' => false)); ?>
<?php $this->Html->script('number_format.min', array('inline' => false)); ?>
<?php $this->Html->script('apu_agregar_editar', array('inline' => false)); ?>


<?php $this->Html->scriptStart(array('inline' => false)); ?>

	var cont_pu = 1;

	$("#opcion_conceptos").addClass("opcion_seleccionada");

	$(document).ready(function() {
		$('select').material_select();
		$('.modal').modal();
	});


	$('#AnalisisPreciosUAddForm').submit(function()
	{
		if($('#partida option:selected').val() == "nada")
		{
			$("#partida-error").css("display", "initial");
			event.preventDefault();
		}
	});


	<?php
		//Validar los inputs
	?>

	$('#AnalisisPreciosUAddForm').validate({
		rules: {
			'data[APU][clave]': {
				required: true,
				alphanumeric: true,
				maxlength: 50
			},
			'data[APU][descripcion]': {
				required: true,
				alphanumeric: true,
				maxlength: 1500
			},
			'data[APU][unidad]': {
				required: true,
				alphanumeric: true,
				maxlength: 50
			},
			'data[ApuPartida][cantidad]': {
				required: true,
				alphanumeric: true,
				min: 0
			}
		}
	});

	$('#PartidaAgregarForm').validate({
		rules: {
			'data[Partida][identificador]': {
				required: true,
				alphanumeric: true,
				maxlength: 50
			},
			'data[Partida][nombre]': {
				required: true,
				alphanumeric: true,
				maxlength: 50
			}
		}
	});




	<?php
		//Revisa que la clave no se repita
	?>

	$('#clave').donetyping(function()
	{ revisarClave(); });

	function revisarClave()
	{
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '/analisis_precios_us/revisar_clave',
	        success: function(response)
	        {
	            $('#cambiar_clave').replaceWith(response);

	            var poner_focus = $("#clave");
				var length_texto = poner_focus.val().length;
				poner_focus.focus();
				poner_focus[0].setSelectionRange(length_texto, length_texto);

	            $('#clave').donetyping(function()
				{ revisarClave(); });
	        },
	        data: {
	        	nueva_clave: $('#clave').val(),
	        	url: "add"
	        }
	    });
	}




	$(document).on("change", "#partida", function()
	{
		$("#partida-error").css("display", "none");

		if($('#partida option:selected').val() == "nueva_partida")
		{
			$('#modal_agregar_partida').modal('open');
		}
	});



	<?php
		//Revisa que el ID de la partida no se repita
	?>

	$('#identificador').donetyping(function()
	{ revisarID(); });

	function revisarID()
	{
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '/partidas/revisar_id',
	        success: function(response)
	        {
	            $('#cambiar_identificador').replaceWith(response);

	            var poner_focus = $("#identificador");
				var length_texto = poner_focus.val().length;
				poner_focus.focus();
				poner_focus[0].setSelectionRange(length_texto, length_texto);

	            $('#identificador').donetyping(function()
				{ revisarID(); });
	        },
	        data: {
	        	nuevo_id: $('#identificador').val(),
	        	url: "add"
	        }
	    });
	}


<?php $this->Html->scriptEnd(); ?>
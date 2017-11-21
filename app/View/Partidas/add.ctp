

<h3>AGREGAR PARTIDA</h3>
<br><br>

<?php echo $this->Form->create(); ?>

	<div class="row margin_nada">
		
		<div id="padding_right" class="col s12 m6 l4">
			
			<div id="cambiar_id" class="input-field">
				<input id="identificador" type="text" name="data[Partida][identificador]">
				<label for="identificador">
					ID
					<label id="identificador-error" class="error validation_label" for="identificador"></label>
				</label>
			</div>

		</div>

		<div id="padding_right" class="col s12 m6 l4">
			
			<div class="input-field">
				<input id="nombre" type="text" name="data[Partida][nombre]">
				<label for="nombre">
					NOMBRE
					<label id="nombre-error" class="error validation_label" for="nombre"></label>
				</label>
			</div>

		</div>
	</div>

	<table class="tabla_modal">
		<thead id="thead">
			<tr>
				<th>APU ID</th>
				<th width="100">
					NÚMERO
				</th>
				<th width="500">
					CONCEPTO
				</th>
				<th width="75" class="center">
					UNIDAD
				</th>
				<th width="125">
					<span class="decimal">P.U.</span>
				</th>
				<th>
					<span class="decimal">CANTIDAD</span>
				</th>
				<th width="125">
					<span class="decimal">IMPORTE</span>
				</th>
				<th></th>
			</tr>
		</thead>

		<tbody id="table_body">
			
		</tbody>
	</table>

	<a id="apu_existente" class="modal-trigger waves-effect waves-black btn">
		P.U. Existente
	</a>

	<a id="apu_nuevo" class="modal-trigger waves-effect waves-black btn">
		P.U. Nuevo
	</a>

	<div class="row">
		<div class="col s12 m6 l4 offset-m6 offset-l8">
			<div class="col s6">
				<span class="decimal bold_grande">SUBTOTAL:</span>
			</div>
			<div class="col s6">
				<span id="partida_total" class="decimal bold_grande">$ 0.00</span>
			</div>
		</div>
	</div>



	<div class="col m12">
		<button class="right btn waves-effect waves-black" type="submit" name="action">
			Terminar
		</button>
	</div>

	<br><br><br><br>


<?php echo $this->Form->end(); ?>



<?php $this->Html->script('donetyping', array('inline' => false)); ?>
<?php $this->Html->script('number_format.min', array('inline' => false)); ?>
<?php $this->Html->script('partida_agregar_editar', array('inline' => false)); ?>


<?php $this->Html->scriptStart(array('inline' => false)); ?>

	<?php
		//Validar inputs
	?>

	$('#PartidaAddForm').submit(function()
	{
		var valido = true;

		if (!ultimaLlena()) valido = false;

		if (!numerosLlenos()) valido = false;

		if (!unidadesLlenas()) valido = false;

		if (!validarNuevosCampos()) valido = false;

		return valido;
	});

	$('#PartidaAddForm').validate({
		rules: {
			'data[Partida][identificador]': {
				required: true,
				alphanumeric: true
			},
			'data[Partida][nombre]': {
				required: true,
				alphanumeric: true
			}
		}
	});

	var cont_apu = 0;





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
	            $('#cambiar_id').replaceWith(response);

	            var poner_focus = $("#identificador");
				var length_texto = poner_focus.val().length;
				poner_focus.focus();
				poner_focus[0].setSelectionRange(length_texto, length_texto);

	            $('#identificador').donetyping(function()
				{ revisarID(); });
	        },
	        data: {
	        	nuevo_id: $('#identificador').val()
	        }
	    });
	}
		

<?php $this->Html->scriptEnd(); ?>
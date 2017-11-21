

<h4>EDITAR PARTIDA</h4>
<br><br>

<?php echo $this->Form->create(); ?>

	<?php echo $this->Form->hidden('id', array('value' => $partida[0]['Partida']['id'], 'name' => 'data[Partida][id]')); ?>

	<div class="row margin_nada">
		
		<div id="padding_right" class="col s12 m6 l4">
			
			<div id="cambiar_identificador" class="input-field">
				<input id="identificador" type="text" name="data[Partida][identificador]" value="<?php echo $partida[0]["Partida"]["identificador"] ?>">
				<label for="identificador">
					ID
					<label id="identificador-error" class="error validation_label" for="identificador"></label>
				</label>
			</div>

		</div>

		<div id="padding_right" class="col s12 m6 l4">
			
			<div class="input-field">
				<input id="nombre" type="text" name="data[Partida][nombre]" value="<?php echo $partida[0]["Partida"]["nombre"] ?>">
				<label for="nombre">
					NOMBRE
					<label id="nombre-error" class="error validation_label" for="nombre"></label>
				</label>
			</div>

		</div>
	</div>

	<!-- <table class="tabla_modal">
		<thead>
			<tr>
				<th>APU ID</th>
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
			
			<?php foreach ($partida[0]["AnalisisPreciosU"] as $key => $apu): ?>
			
				<tr id="tr_<?php echo $key; ?>">
					<input type="hidden" id="hidden_<?php echo $key; ?>" name="data[APU][<?php echo $key ?>][clave]" value="<?php echo $apu["AnalisisPreciosU"]["clave"] ?>">
					<td>
						<div class="border_top"></div>
						<input disabled="" class="en_modal soy_id" id="apu_<?php echo $key; ?>" type="text" value="<?php echo $apu["AnalisisPreciosU"]["clave"] ?>">
					</td>
					<td width="500">
						<div class="border_top"></div>
						<span class="en_modal" id="descripcion_<?php echo $key; ?>">
							<?php echo $apu["AnalisisPreciosU"]["descripcion"] ?>
						</span>
					</td>
					<td class="center">
						<div class="border_top"></div>
						<input disabled="" class="en_modal center todas_unidad" id="unidad_<?php echo $key; ?>" value="<?php echo $apu["AnalisisPreciosU"]["unidad"] ?>">
					</td>
					<td>
						<div class="border_top"></div>
						<input disabled="" class="en_modal right-align" id="pu_<?php echo $key; ?>" value="<?php echo number_format($apu["AnalisisPreciosU"]["importe"], 2) ?>">
					</td>
					<td>
						<div class="border_top"></div>
						<input class="en_modal right-align para_escribir" id="cantidad_<?php echo $key; ?>" name="data[APU][<?php echo $key ?>][cantidad]" type="number" value="<?php echo $apu["ApuPartida"]["cantidad"] ?>">
					</td>
					<td>
						<div class="border_top"></div>
						<input disabled="" class="en_modal right-align" id="importe_<?php echo $key; ?>" value="<?php echo number_format(round($apu["AnalisisPreciosU"]["importe"], 2) * floatval($apu["ApuPartida"]["cantidad"]), 2); ?>">
					</td>
					<td class="center">
						<a id="remover_<?php echo $key; ?>" class="btn-floating waves-effect waves-light white btn_border btn_peque">
							<i class="material-icons">remove</i>
						</a>
					</td>
				</tr>

				<?php $cont_apu = $key + 1 ?>
			<?php endforeach ?>

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
				<span id="partida_total" class="decimal bold_grande">
					$ <?php echo number_format($partida[0]["Partida"]["importe"], 2) ?>
				</span>
			</div>
		</div>
	</div> -->



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

	$('#PartidaEditForm').submit(function()
	{
		var valido = true;

		if (!ultimaLlena()) valido = false;

		if (!numerosLlenos()) valido = false;

		if (!unidadesLlenas()) valido = false;

		if (!validarNuevosCampos()) valido = false;

		return valido;
	});

	$('#PartidaEditForm').validate({
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

	<?php if (!empty($cont_apu)): ?>
		var cont_apu = <?php echo $cont_apu ?>;
	<?php else: ?>
		var cont_apu = 0;
	<?php endif ?>





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
	        	id_actual: '<?php echo $partida[0]["Partida"]["identificador"] ?>',
	        	url: "edit"
	        }
	    });
	}

	<?php
		//Para los APU que ya se despliegan
	?>
	<?php foreach ($partida[0]["AnalisisPreciosU"] as $key => $apu): ?>

		$(document).on("click", "#remover_<?php echo $key; ?>", function(){
			removerFila(<?php echo $key; ?>);
		});

		$(document).on("keyup paste change", "#numero_<?php echo $key; ?>", function(){
			yaEsValido($(this));
		});

		$(document).on("keyup paste change", "#cantidad_<?php echo $key; ?>", function(){
			yaEsValido($(this));
			validarCantidad(<?php echo $key; ?>);
		});
		
	<?php endforeach ?>
		

<?php $this->Html->scriptEnd(); ?>
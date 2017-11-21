

<h4>EDITAR PRESUPUESTO</h4>
<br><br>

<?php echo $this->Form->create(); ?>

	<?php echo $this->Form->hidden('id', array('value' => $presupuesto[0]['Presupuesto']['id'], 'name' => 'data[Presupuesto][id]')); ?>

	<div class="row margin_nada">
		
		<div id="padding_right" class="col s12 m6">
			
			<div class="input-field">
				<input id="obra" type="text" name="data[Presupuesto][obra]" value="<?php echo $presupuesto[0]['Presupuesto']['obra'] ?>">
				<label for="obra">
					OBRA
					<label id="obra-error" class="error validation_label" for="obra"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="ubicacion" type="text" name="data[Presupuesto][ubicacion]" value="<?php echo $presupuesto[0]['Presupuesto']['ubicacion'] ?>">
				<label for="ubicacion">
					UBICACIÓN
					<label id="ubicacion-error" class="error validation_label" for="ubicacion"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="colonia" type="text" name="data[Presupuesto][colonia]" value="<?php echo $presupuesto[0]['Presupuesto']['colonia'] ?>">
				<label for="colonia">
					COLONIA
					<label id="colonia-error" class="error validation_label" for="colonia"></label>
				</label>
			</div>

		</div>

		<div id="padding_left" class="col s12 m6">
			
			<div class="input-field">
				<input id="contratista" type="text" name="data[Presupuesto][contratista]" value="<?php echo $presupuesto[0]['Presupuesto']['contratista'] ?>">
				<label for="contratista">
					CONTRATISTA
					<label id="contratista-error" class="error validation_label" for="contratista"></label>
				</label>
			</div>

		</div>
	</div>

	<!-- <table class="tabla_modal">
		<thead>
			<tr>
				<th>PARTIDA ID</th>
				<th>
					NÚMERO
				</th>
				<th>
					NOMBRE
				</th>
				<th>
					<span class="decimal">IMPORTE</span>
				</th>
				<th></th>
			</tr>
		</thead>

		<tbody id="table_body">

			<?php if (!empty($presupuesto[0]["Partidas"]))
				foreach ($presupuesto[0]["Partidas"] as $key => $partida): ?>
				
				<tr id="tr_<?php echo $key; ?>">
					<input type="hidden" id="hidden_<?php echo $key; ?>" name="data[Partida][<?php echo $key ?>][identificador]" value="<?php echo $partida[0]["Partida"]["identificador"] ?>">
					<td>
						<div class="border_top"></div>
						<input class="en_modal para_escribir soy_id" id="partida_<?php echo $key; ?>" placeholder="Escribir ID" type="text" value="<?php echo $partida[0]["Partida"]["identificador"] ?>">
					</td>
					<td>
						<div class="border_top"></div>
						<input class="en_modal para_escribir todos_numeros" id="numero_<?php echo $key; ?>" name="data[Partida][<?php echo $key ?>][numero]" type="text" value="<?php echo $partida[0]["Partida"]["numero"] ?>">
					</td>
					<td>
						<div class="border_top"></div>
						<input disabled="" class="en_modal" id="nombre_<?php echo $key; ?>" value="<?php echo $partida[0]["Partida"]["nombre"] ?>">
					</td>
					<td>
						<div class="border_top"></div>
						<input disabled="" class="en_modal right-align" id="importe_<?php echo $key; ?>" value="<?php echo number_format($partida[0]["Partida"]["importe"], 2) ?>">
					</td>
					<td class="center">
						<a id="remover_<?php echo $key; ?>" class="btn-floating waves-effect waves-light white btn_border btn_peque">
							<i class="material-icons">remove</i>
						</a>
					</td>
				</tr>

			<?php endforeach ?>
		</tbody>
	</table>

	<a id="agregar" class="modal-trigger waves-effect waves-black btn">
		AGREGAR
	</a> -->

	<div class="row">
		<div class="col s12 m6 l4 offset-m6 offset-l8">
			<div class="border_top margin_bottom"></div>
			<div class="col s6">
				<span class="decimal">TOTAL:</span>
			</div>
			<div class="col s6">
				<span id="total" class="decimal">
					$ <?php echo number_format($presupuesto[0]["Presupuesto"]["importe"], 2) ?>
				</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s12 m6 l4 offset-m6 offset-l8">
			<div class="col s6">
				<span class="decimal">IVA(16%):</span>
			</div>
			<div class="col s6">
				<span id="iva" class="decimal">
					$ <?php echo number_format($presupuesto[0]["Presupuesto"]["importe"]*0.16, 2) ?>
				</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s12 m6 l4 offset-m6 offset-l8">
			<div class="border_top margin_bottom"></div>
			<div class="col s6">
				<span class="decimal bold_grande">GRAN TOTAL:</span>
			</div>
			<div class="col s6">
				<span id="gran_total" class="decimal bold_grande">
					$ <?php echo number_format($presupuesto[0]["Presupuesto"]["importe"]*1.16, 2) ?>
				</span>
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
<?php $this->Html->script('presupuesto_agregar_editar', array('inline' => false)); ?>


<?php $this->Html->scriptStart(array('inline' => false)); ?>

	<?php
		//Validar inputs
	?>

	$("#opcion_presupuestos").addClass("opcion_seleccionada");
	$("#bread_presupuesto_nombre").addClass("hide");

	$('#PresupuestoEditForm').submit(function()
	{
		var valido = true;

		if (!ultimaLlena()) valido = false;

		if (!numerosLlenos()) valido = false;

		return valido;
	});

	$('#PresupuestoEditForm').validate({
		rules: {
			'data[Presupuesto][obra]': {
				required: true,
				alphanumeric: true,
				maxlength: 150
			},
			'data[Presupuesto][ubicacion]': {
				required: true,
				alphanumeric: true,
				maxlength: 150
			},
			'data[Presupuesto][contratista]': {
				required: true,
				alphanumeric: true,
				maxlength: 150
			},
			'data[Presupuesto][colonia]': {
				required: true,
				alphanumeric: true,
				maxlength: 150
			}
		}
	});





	<?php
		//Para los APU que ya se despliegan
	?>
	<?php if (!empty($presupuesto[0]["Partidas"]))
		foreach ($presupuesto[0]["Partidas"] as $key => $partida): ?>

		$('#partida_<?php echo $key ?>').donetyping(function(){
			traerInfoPartida(<?php echo $key ?>);
		});

		$(document).on("keyup paste change", "#numero_<?php echo $key ?>", function(){
			yaEsValido($(this));
		})

        $(document).on("click", "#remover_<?php echo $key ?>", function(){
			removerFila(<?php echo $key ?>);
		});
		
		<?php $cont_partida = $key + 1 ?>
	<?php endforeach ?>


	<?php if (!empty($cont_partida)): ?>
		var cont_partida = <?php echo $cont_partida ?>;
	<?php else: ?>
		var cont_partida = 0;
	<?php endif ?>
		

<?php $this->Html->scriptEnd(); ?>
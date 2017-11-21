

<h4>AGREGAR PRESUPUESTO</h4>
<br><br>

<?php echo $this->Form->create(); ?>

	<div class="row margin_nada">
		
		<div id="padding_right" class="col s12 m6">
			
			<div class="input-field">
				<input id="obra" type="text" name="data[Presupuesto][obra]">
				<label for="obra">
					OBRA
					<label id="obra-error" class="error validation_label" for="obra"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="ubicacion" type="text" name="data[Presupuesto][ubicacion]">
				<label for="ubicacion">
					UBICACIÓN
					<label id="ubicacion-error" class="error validation_label" for="ubicacion"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="colonia" type="text" name="data[Presupuesto][colonia]">
				<label for="colonia">
					COLONIA
					<label id="colonia-error" class="error validation_label" for="colonia"></label>
				</label>
			</div>

		</div>

		<div id="padding_left" class="col s12 m6">
			
			<div class="input-field">
				<input id="contratista" type="text" name="data[Presupuesto][contratista]">
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
			
		</tbody>
	</table>

	<a id="agregar" class="modal-trigger waves-effect waves-black btn">
		AGREGAR
	</a>

	<div class="row">
		<div class="col s12 m6 l4 offset-m6 offset-l8">
			<div class="border_top margin_bottom"></div>
			<div class="col s6">
				<span class="decimal">TOTAL:</span>
			</div>
			<div class="col s6">
				<span id="total" class="decimal">$ 0.00</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s12 m6 l4 offset-m6 offset-l8">
			<div class="col s6">
				<span class="decimal">IVA(16%):</span>
			</div>
			<div class="col s6">
				<span id="iva" class="decimal">$ 0.00</span>
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
				<span id="gran_total" class="decimal bold_grande">$ 0.00</span>
			</div>
		</div>
	</div> -->


	<div class="col m12">
		<button class="right btn waves-effect waves-black" type="submit" name="action">
			Agregar Conceptos
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

	$('#PresupuestoAddForm').submit(function()
	{
		var valido = true;

		if (!ultimaLlena()) valido = false;

		if (!numerosLlenos()) valido = false;

		return valido;
	});

	$('#PresupuestoAddForm').validate({
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

	var cont_partida = 0;

<?php $this->Html->scriptEnd(); ?>
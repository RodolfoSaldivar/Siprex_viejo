

<div class="row margin_nada">
	<div class="col s12 m6">
		<h4>
			NUEVO
			<a href="/presupuestos/add" class="btn-floating btn-large waves-effect waves-light">
				<i class="material-icons">add</i>
			</a>
		</h4>
	</div>

	<div class="col s12 m6">
		<?php include 'buscador.ctp';?>
	</div>
</div>

<table class="">
	<thead>
		<tr>
			<th>OBRA</th>
			<th>COLONIA</th>
			<th>UBICACIÓN</th>
			<th>
				<span class="decimal">IMPORTE</span>
			</th>
		</tr>
	</thead>

	<tbody id="filtro_cambiar">
		<?php foreach ($presupuestos as $key => $presupuesto): ?>
			<tr>
				<td>
					<div class="border_top"></div>
					<?php echo $presupuesto['Presupuesto']['obra'] ?>
				</td>
				<td>
					<div class="border_top"></div>
					<?php echo $presupuesto['Presupuesto']['colonia'] ?>
				</td>
				<td>
					<div class="border_top"></div>
					<?php echo $presupuesto['Presupuesto']['ubicacion'] ?>
				</td>
				<td>
					<div class="border_top"></div>
					<span class="decimal">
						$ <?php echo number_format($presupuesto['Presupuesto']['importe']*1.16, 2) ?>
					</span>
				</td>
				<td>
					<a href="/presupuestos/view/<?php echo $presupuesto['Presupuesto']['id'] ?>">
						<i class="material-icons">visibility</i>
					</a>
					<br>
					<a href="/presupuestos/edit/<?php echo $presupuesto['Presupuesto']['id'] ?>">
						<i class="material-icons">edit</i>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$("#opcion_proyectos").addClass("opcion_seleccionada");

<?php $this->Html->scriptEnd(); ?>
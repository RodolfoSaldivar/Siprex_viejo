

<div class="row margin_nada">
	<div class="col s12 m6">
		<h4>
			REUSAR INSUMO
		</h4>
	</div>

	<div class="col s12 m6">
		<?php include 'buscador.ctp';?>
	</div>
</div>


<table class="">
	<thead>
		<tr>
			<th>ID</th>
			<th>FAMILIA</th>
			<th>TIPO DE INSUMO</th>
			<th>DESCRIPCIÓN</th>
		</tr>
	</thead>

	<tbody id="filtro_cambiar">
		<?php foreach ($insumos as $key => $insumo): ?>
			<tr>
				<td>
					<div class="border_top"></div>
					<?php echo $insumo['Insumo']['identificador'] ?>
				</td>
				<td>
					<div class="border_top"></div>
					<?php echo $insumo['Insumo']['referencia'] ?>
				</td>
				<td>
					<div class="border_top"></div>
					<?php echo $insumo['Insumo']['tipo_insumo'] ?>
				</td>
				<td>
					<div class="border_top"></div>
					<?php echo $insumo['Insumo']['descripcion'] ?>
				</td>
				<td>
					<a href="/insumos/edit/<?php echo $insumo['Insumo']['id'] ?>/1">
						<i class="material-icons">autorenew</i>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$("#opcion_insumos").addClass("opcion_seleccionada");

<?php $this->Html->scriptEnd(); ?>


<div class="row margin_nada">
	<div class="col s12 m6">
		<h4>
			INSUMOS
			<a href="/insumos/add" class="btn-floating btn-large waves-effect waves-light">
				<i class="material-icons">add</i>
			</a>
			<a href="/insumos/reuse" class="btn-floating btn-large waves-effect waves-light">
				<i class="material-icons">autorenew</i>
			</a>
		</h4>
	</div>

	<div class="col s12 m6">
		<?php include 'buscador.ctp';?>
		
		<div class="padding_top"></div>
		<a href="/insumos/subir_excel" class="waves-effect waves-light btn right">
			Carga Masiva
		</a>
		
		<div class="padding_top"></div>
		<div class="padding_top"></div>
		<a href="/insumos/download" class="waves-effect waves-light btn right" target="_blank">
			Descargar Lista
		</a>
	</div>
</div>


<table class="">
	<thead>
		<tr>
			<th>ID</th>
			<th>FAMILIA</th>
			<th>TIPO DE INSUMO</th>
			<th>DESCRIPCIÓN</th>
			<th>UNIDAD</th>
			<th>
				<span class="decimal">PRECIO VENTA</span>
			</th>
		</tr>
	</thead>

	<tbody id="filtro_cambiar">
		<?php foreach ($insumos as $key => $insumo): ?>
			<tr>
				<td width="70">
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
					<div class="border_top"></div>
					<?php echo $insumo['Insumo']['unidad'] ?>
				</td>
				<td>
					<div class="border_top"></div>
					<span class="decimal">
						<?php echo "$ ".number_format($insumo['Insumo']['precio_venta'], 2) ?>
					</span>
				</td>
				<td>
					<a href="/insumos/view/<?php echo $insumo['Insumo']['id'] ?>">
						<i class="material-icons">visibility</i>
					</a>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="/insumos/edit/<?php echo $insumo['Insumo']['id'] ?>">
						<i class="material-icons">edit</i>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$("#opcion_insumos").addClass("opcion_seleccionada");

<?php $this->Html->scriptEnd(); ?>


<tbody id="filtro_cambiar">
	<?php foreach ($insumos as $key => $insumo): ?>
		<tr>
			<td width="70">
				<div class="border_top"></div>
				<?php echo $insumo['Insumo']['identificador'] ?>
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
					<?php echo "$ ".number_format($insumo['Insumo']['precio_compra'], 2) ?>
				</span>
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
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="/insumos/edit/<?php echo $insumo['Insumo']['id'] ?>">
					<i class="material-icons">edit</i>
				</a>
			</td>
		</tr>
	<?php endforeach ?>
</tbody>
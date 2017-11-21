


<tbody id="tbody_insumos" class="ui-helper-reset ui-helper-clearfix">
	<?php foreach ($insumos as $key => $insumo): ?>
		<tr class="ui-widget-content ui-corner-tr" id="tr_<?php echo $insumo["Insumo"]["id_e"] ?>">
			<td class="icon_remover">
				<i class="material-icons">pan_tool</i>
			</td>
			<td class="icon_remover">
				<div class="border_top"></div>
				<?php echo $insumo["Insumo"]["identificador"] ?>
			</td>
			<td class="icon_remover">
				<div class="border_top"></div>
				<?php echo $insumo["Insumo"]["descripcion"] ?>
			</td>
			<td class="icon_remover">
				<div class="border_top"></div>
				<?php echo $insumo["Insumo"]["unidad"] ?>
			</td>
			<td class="icon_remover">
				<div class="border_top"></div>
				<?php echo $insumo["Insumo"]["precio_venta"] ?>
			</td>


			<td class="hide quitar_hide">
				<div class="border_top"></div>
				<div class="input-field">
					<input disabled="" class="en_modal identificador" type="text" value="<?php echo $insumo["Insumo"]["identificador"] ?>">
				</div>
			</td>
			<td class="hide quitar_hide">
				<div class="border_top"></div>
				<div class="input-field">
					<input disabled="" class="en_modal descripcion" type="text" value="<?php echo $insumo["Insumo"]["descripcion"] ?>">
				</div>
			</td>
			<td class="hide quitar_hide">
				<div class="border_top"></div>
				<div class="input-field">
					<input disabled="" class="en_modal center unidad" type="text" value="<?php echo $insumo["Insumo"]["unidad"] ?>">
				</div>
			</td>
			<td class="hide quitar_hide">
				<div class="border_top"></div>
				<div class="input-field">
					<input disabled="" class="en_modal right-align precio_venta" type="text" value="<?php echo $insumo["Insumo"]["precio_venta"] ?>">
				</div>
			</td>
			<td class="hide quitar_hide">
				<div class="border_top"></div>
				<div class="input-field">
					<input onchange="calcularCantidad(this)" type="number" min="0" step="any" class="en_modal right-align para_escribir cantidad_validar" type="text" value="1">
				</div>
			</td>
			<td class="hide quitar_hide">
				<div class="border_top"></div>
				<div class="input-field">
					<input disabled="" class="en_modal right-align precio" type="text" value="<?php echo $insumo["Insumo"]["precio_venta"] ?>">
				</div>
			</td>
		</tr>
	<?php endforeach ?>
</tbody>
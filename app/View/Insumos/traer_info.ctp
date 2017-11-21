


<tr id="tr_<?php echo $cont_insumo; ?>" name="<?php echo $cont_insumo; ?>">
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input class="en_modal para_escribir" id="insumo_<?php echo $cont_insumo; ?>" type="text" placeholder="Escribir ID" value="<?php echo $identificador ?>">
		</div>
	</td>
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input disabled="" id="modal_descripcion_<?php echo $cont_insumo; ?>" class="en_modal" value="<?php echo @$insumo["descripcion"] ?>">
		</div>
	</td>
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input disabled="" id="modal_unidad_<?php echo $cont_insumo; ?>" class="en_modal center" value="<?php echo @$insumo["unidad"] ?>">
		</div>
	</td>
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input disabled="" id="modal_precio_venta_<?php echo $cont_insumo; ?>" class="en_modal right-align" value="<?php echo @number_format($insumo["precio_venta"], 2) ?>">
		</div>
	</td>
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input id="modal_cantidad_<?php echo $cont_insumo; ?>" class="en_modal right-align para_escribir" type="number" value="1">
		</div>
	</td>
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input disabled="" id="modal_precio_<?php echo $cont_insumo; ?>" class="en_modal right-align" value="<?php echo @number_format($insumo["precio_venta"] * $insumo["cantidad"], 2) ?>">
		</div>
	</td>
	<?php if ($cont_insumo != 1): ?>
		<td>
			<a id="remover_<?php echo $cont_insumo; ?>" class="btn-floating btn-small waves-effect waves-black white btn_border"><i class="material-icons">remove</i></a>
		</td>
	<?php endif ?>
</tr>
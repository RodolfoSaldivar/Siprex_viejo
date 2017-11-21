


<tr id="tr_<?php echo $keyP."_".$keyI; ?>" name="<?php echo $keyP."_".$keyI; ?>" class="categoria_<?php echo $keyP; ?>">
	<input type="hidden" id="hidden_<?php echo $keyP."_".$keyI; ?>" name="data[PU][<?php echo $keyP ?>][Insumos][<?php echo $insumo["identificador"] ?>]" value="<?php echo number_format($insumo["cantidad"], 4) ?>">
	<td>
		<div class="input-field">
			<input class="en_modal para_escribir soy_id" id="insumo_<?php echo $keyP."_".$keyI; ?>" type="text" placeholder="Escribir ID" value="<?php echo $identificador ?>">
		</div>
	</td>
	<td>
		<div class="input-field">
			<input disabled="" id="descripcion_<?php echo $keyP."_".$keyI; ?>" class="en_modal des_lleno" value="<?php echo @$insumo["descripcion"] ?>">
		</div>
	</td>
	<td>
		<div class="input-field">
			<input disabled="" id="unidad_<?php echo $keyP."_".$keyI; ?>" class="en_modal center" value="<?php echo @$insumo["unidad"] ?>">
		</div>
	</td>
	<td>
		<span class="decimal en_modal right-align" id="precio_<?php echo $keyP."_".$keyI; ?>">
			<?php echo number_format($insumo["precio_venta"], 2) ?>
		</span>
	</td>
	<td>
		<div class="input-field">
			<input id="cantidad_<?php echo $keyP."_".$keyI; ?>" class="en_modal right-align para_escribir" type="number" value="<?php echo @$insumo["cantidad"] ?>">
		</div>
	</td>
	<td>
		<span class="decimal en_modal right-align" id="total_<?php echo $keyP."_".$keyI; ?>">
			<?php echo @number_format($insumo["precio_venta"] * $insumo["cantidad"], 2) ?>
		</span>
	</td>
	<td>
		<a id="remover_<?php echo $keyP."_".$keyI; ?>" class="btn-floating btn-small waves-effect waves-black white btn_border btn_peque"><i class="material-icons">remove</i></a>
	</td>
</tr>
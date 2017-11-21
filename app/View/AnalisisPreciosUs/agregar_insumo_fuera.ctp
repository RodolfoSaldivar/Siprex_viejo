


<tr id="tr_<?php echo $keyP."_".$keyI; ?>" class="categoria_<?php echo $keyP; ?>">
	<input type="hidden" id="hidden_<?php echo $keyP."_".$keyI; ?>" name="data[PU][<?php echo $keyP ?>][Insumos][<?php echo $insumo["identificador"] ?>]" value="<?php echo $insumo["cantidad"] ?>">
	<td>
		<div class="input-field">
			<input class="en_modal para_escribir soy_id" id="insumo_<?php echo $keyP."_".$keyI; ?>" type="text" placeholder="Escribir ID">
		</div>
	</td>
	<td>
		<div class="input-field">
			<input disabled="" id="descripcion_<?php echo $keyP."_".$keyI; ?>" class="en_modal des_lleno" value="">
		</div>
	</td>
	<td>
		<div class="input-field">
			<input disabled="" id="unidad_<?php echo $keyP."_".$keyI; ?>" class="en_modal center" value="">
		</div>
	</td>
	<td>
		<span class="decimal en_modal right-align" id="precio_<?php echo $keyP."_".$keyI; ?>">
			0.00
		</span>
	</td>
	<td>
		<div class="input-field">
			<input disabled="" id="cantidad_<?php echo $keyP."_".$keyI; ?>" class="en_modal right-align" value="">
		</div>
	</td>
	<td>
		<span class="decimal en_modal right-align" id="total_<?php echo $keyP."_".$keyI; ?>">
			0.00
		</span>
	</td>
	<td>
		<a id="remover_<?php echo $keyP."_".$keyI; ?>" class="btn-floating btn-small waves-effect waves-light white btn_border btn_peque"><i class="material-icons">remove</i></a>
	</td>
</tr>
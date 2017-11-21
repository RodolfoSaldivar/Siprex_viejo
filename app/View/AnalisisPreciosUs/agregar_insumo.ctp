


<tr id="tr_<?php echo $cont_insumo; ?>" name="<?php echo $cont_insumo; ?>">
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input class="en_modal para_escribir" id="insumo_<?php echo $cont_insumo; ?>" type="text" placeholder="Escribir ID">
		</div>
	</td>
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input disabled="" id="modal_descripcion_<?php echo $cont_insumo; ?>" class="en_modal" value="">
		</div>
	</td>
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input disabled="" id="modal_unidad_<?php echo $cont_insumo; ?>" class="en_modal center" value="">
		</div>
	</td>
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input disabled="" id="modal_precio_venta_<?php echo $cont_insumo; ?>" class="en_modal right-align" value="">
		</div>
	</td>
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input disabled="" id="modal_cantidad_<?php echo $cont_insumo; ?>" class="en_modal right-align" value="">
		</div>
	</td>
	<td>
		<div class="border_top"></div>
		<div class="input-field">
			<input disabled="" id="modal_precio_<?php echo $cont_insumo; ?>" class="en_modal right-align" value="">
		</div>
	</td>
	<?php if ($cont_insumo != 1): ?>
		<td>
			<a id="remover_<?php echo $cont_insumo; ?>" class="btn-floating btn-small waves-effect waves-light white btn_border"><i class="material-icons">remove</i></a>
		</td>
	<?php endif ?>
</tr>
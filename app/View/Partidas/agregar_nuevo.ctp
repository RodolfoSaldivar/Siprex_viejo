


<tr id="tr_<?php echo $cont_apu; ?>">
	<td>
		<div class="border_top"></div>
		<input class="en_modal para_escribir campos_nuevos" id="apu_<?php echo $cont_apu; ?>" name="data[Nuevos][<?php echo $cont_apu ?>][clave]" type="text">
	</td>
	<td>
		<div class="border_top"></div>
		<input class="en_modal para_escribir campos_nuevos" id="numero_<?php echo $cont_apu; ?>" name="data[Nuevos][<?php echo $cont_apu ?>][numero]" value="" type="text">
	</td>
	<td>
		<textarea id="descripcion_<?php echo $cont_apu; ?>" class="materialize-textarea para_escribir campos_nuevos" name="data[Nuevos][<?php echo $cont_apu ?>][descripcion]" type="text"></textarea>
	</td>
	<td class="center">
		<div class="border_top"></div>
		<input class="en_modal center para_escribir campos_nuevos" id="unidad_<?php echo $cont_apu; ?>" name="data[Nuevos][<?php echo $cont_apu ?>][unidad]" value="" type="text">
	</td>
	<td>
		<div class="border_top"></div>
		<input disabled="" class="en_modal right-align" id="pu_<?php echo $cont_apu; ?>" value="0.00">
	</td>
	<td>
		<div class="border_top"></div>
		<input class="en_modal para_escribir campos_nuevos right-align" id="cantidad_<?php echo $cont_apu; ?>" name="data[Nuevos][<?php echo $cont_apu ?>][cantidad]" value="" type="number">
	</td>
	<td>
		<div class="border_top"></div>
		<input disabled="" class="en_modal right-align" id="importe_<?php echo $cont_apu; ?>" value="0.00">
	</td>
	<td class="center">
		<a id="remover_<?php echo $cont_apu; ?>" class="btn-floating waves-effect waves-light white btn_border btn_peque">
			<i class="material-icons">remove</i>
		</a>
	</td>
</tr>
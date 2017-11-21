


<tr id="tr_<?php echo $cont_apu; ?>">
	<input type="hidden" id="hidden_<?php echo $cont_apu; ?>" name="data[APU][<?php echo $cont_apu ?>][clave]" value="<?php echo $clave ?>">
	<td>
		<div class="border_top"></div>
		<input class="en_modal para_escribir soy_id" id="apu_<?php echo $cont_apu; ?>" placeholder="Escribir ID" value="<?php echo $clave ?>" type="text">
	</td>
	<td>
		<div class="border_top"></div>
		<input class="en_modal para_escribir todos_numeros" id="numero_<?php echo $cont_apu; ?>" name="data[APU][<?php echo $cont_apu ?>][numero]" value="" type="text">
	</td>
	<td>
		<div class="border_top"></div>
		<?php if (!empty($apu["descripcion"])): ?>
			<span class="en_modal" id="descripcion_<?php echo $cont_apu; ?>">
				<?php echo $apu["descripcion"] ?>
			</span>
		<?php else: ?>
			<span class="en_modal white-text" id="descripcion_<?php echo $cont_apu; ?>">
				-<br>-
			</span>
		<?php endif ?>
		
	</td>
	<td class="center">
		<div class="border_top"></div>
		<input disabled="" class="en_modal center todas_unidad" id="unidad_<?php echo $cont_apu; ?>" value="<?php echo $apu["unidad"] ?>">
	</td>
	<td>
		<div class="border_top"></div>
		<input disabled="" class="en_modal right-align" id="pu_<?php echo $cont_apu; ?>" value="<?php echo number_format($apu["total"], 2) ?>">
	</td>
	<td>
		<div class="border_top"></div>
		<input class="en_modal right-align para_escribir" id="cantidad_<?php echo $cont_apu; ?>" name="data[APU][<?php echo $cont_apu ?>][cantidad]" type="number" value="<?php echo @$cantidad ?>">
	</td>
	<td>
		<div class="border_top"></div>
		<input disabled="" class="en_modal right-align" id="importe_<?php echo $cont_apu; ?>" value="<?php echo number_format($apu["total"], 2) ?>">
	</td>
	<td class="center">
		<a id="remover_<?php echo $cont_apu; ?>" class="btn-floating waves-effect waves-light white btn_border btn_peque">
			<i class="material-icons">remove</i>
		</a>
	</td>
</tr>
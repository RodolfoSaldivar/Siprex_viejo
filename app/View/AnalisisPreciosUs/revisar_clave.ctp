

<?php if ($url == "add"): ?>

	<td id="cambiar_clave">
		<div class="border_top"></div>
		<label id="clave-error" class="error validation_label" for="clave"></label>
		<input class="en_modal para_escribir campos_nuevos" id="clave" name="data[APU][clave]" type="text" placeholder="<?php echo $placeholder ?>" value="<?php echo $clave ?>">
		<label for="clave">
	</td>

<?php else: ?>

	<div id="cambiar_clave" class="input-field">
		<input id="clave" type="text" name="data[APU][clave]" placeholder="<?php echo $placeholder ?>" value="<?php echo $clave ?>">
		<label for="clave">
			ID
			<label id="clave-error" class="error validation_label" for="clave"></label>
		</label>
	</div>

<?php endif ?>
	
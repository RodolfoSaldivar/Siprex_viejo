

<?php if ($url == "add"): ?>
	
	<div id="cambiar_identificador" class="input-field col s12 m6">
		<input id="identificador" type="text" name="data[Partida][identificador]" placeholder="<?php echo $placeholder ?>" value="<?php echo $identificador ?>">
		<label for="identificador">
			ID PARTIDA
			<label id="identificador-error" class="error validation_label" for="identificador"></label>
		</label>
	</div>

<?php else: ?>

	<div id="cambiar_identificador" class="input-field">
		<input id="identificador" type="text" name="data[Partida][identificador]" placeholder="<?php echo $placeholder ?>" value="<?php echo $identificador ?>">
		<label for="identificador">
			ID
			<label id="identificador-error" class="error validation_label" for="identificador"></label>
		</label>
	</div>

<?php endif ?>
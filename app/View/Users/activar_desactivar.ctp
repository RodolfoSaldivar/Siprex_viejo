

<div class="switch">
	<label>
		<input <?php if ($usuario["User"]["activo"] == 1) echo "checked"; ?> type="checkbox" id='usuario_<?php echo $usuario["User"]["id"] ?>' value='<?php echo $usuario["User"]["activo"] ?>' onchange="activarDesactivar('<?php echo $usuario["User"]["id"] ?>')">
		<span class="lever"></span>
	</label>
</div>
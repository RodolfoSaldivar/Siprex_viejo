

<div class="switch" id="cambiame_<?php echo $empresa["id"] ?>">
	<label>
		No
		<input
			<?php if ($empresa["activo"] == 1) echo "checked"; ?>
			id="activo_<?php echo $empresa["id"] ?>"
			value="<?php echo $empresa["activo"] ?>"
			type="checkbox"
		>
		<span class="lever"></span>
		Si
	</label>
</div>


<h3>DATOS DE INSUMO</h3>
<br><br>

<div class="row">
	
	<div id="padding_right" class="col m6">
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $insumo["Insumo"]["identificador"] ?>">
			<label for="identificador">
				ID
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $insumo["Insumo"]["tipo_insumo"] ?>">
			<label for="tipo_insumo">
				TIPO DE INSUMO
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $insumo["Insumo"]["referencia"] ?>">
			<label for="referencia">
				FAMILIA
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $insumo[0]["contacto"] ?>">
			<label for="contacto">
				CONTACTO
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $insumo["Insumo"]["marca"] ?>">
			<label for="marca">
				MARCA
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $insumo["Insumo"]["modelo"] ?>">
			<label for="modelo">
				MODELO
			</label>
		</div>

	</div>

	<div id="padding_left" class="col s6">
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $insumo["Insumo"]["cantidad"] ?>">
			<label for="cantidad">
				CANTIDAD
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo $insumo["Insumo"]["unidad"] ?>">
			<label for="unidad">
				UNIDAD
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo "$ ". number_format($insumo["Insumo"]["precio_compra"], 2) ?>">
			<label for="precio_compra">
				PRECIO COMPRA
			</label>
		</div>
		
		<div class="input-field">
			<input disabled type="text" value="<?php echo "$ ". number_format($insumo["Insumo"]["precio_venta"], 2) ?>">
			<label for="precio_venta">
				PRECIO VENTA
			</label>
		</div>

		<div class="input-field">
			<textarea disabled id="descripcion" class="materialize-textarea"></textarea>
			<label for="descripcion" class="textarea_label">
				DESCRIPCIÓN
			</label>
		</div>

	</div>

</div>



<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$('#descripcion').val('<?php echo $insumo["Insumo"]["descripcion"] ?>');
  	$('#descripcion').trigger('autoresize');

<?php $this->Html->scriptEnd(); ?>
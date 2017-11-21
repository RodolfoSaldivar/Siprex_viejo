


<tr>
	<input type="hidden" name="data[PU][<?php echo $datos["cont_pu"] ?>][Insumos][<?php echo $datos["identificador"] ?>]" value="<?php echo $datos["cantidad"] ?>">
	<td>
		<?php echo $datos["identificador"] ?>
	</td>
	<td>
		<?php echo $datos["descripcion"] ?>
	</td>
	<td class="center">
		<?php echo $datos["unidad"] ?>
	</td>
	<td>
		<span class="decimal">
			<?php echo number_format($datos["precio_venta"], 2) ?>
		</span>
	</td>
	<td>
		<span class="decimal">
			<?php echo $datos["cantidad"] ?>
		</span>
	</td>
	<td>
		<span class="decimal">
			<?php echo number_format($datos["cantidad"]*$datos["precio_venta"], 2) ?>
		</span>
	</td>
</tr>



<tbody id="filtro_cambiar">
	<?php foreach ($presupuestos as $key => $presupuesto): ?>
		<tr>
			<td>
				<div class="border_top"></div>
				<?php echo $presupuesto['Presupuesto']['obra'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<?php echo $presupuesto['Presupuesto']['colonia'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<?php echo $presupuesto['Presupuesto']['ubicacion'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<span class="decimal">
					$ <?php echo number_format($presupuesto['Presupuesto']['importe'], 2) ?>
				</span>
			</td>
			<td>
				<a href="/presupuestos/view/<?php echo $presupuesto['Presupuesto']['id'] ?>">
					<i class="material-icons">visibility</i>
				</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="/presupuestos/edit/<?php echo $presupuesto['Presupuesto']['id'] ?>">
					<i class="material-icons">edit</i>
				</a>
			</td>
		</tr>
	<?php endforeach ?>
</tbody>
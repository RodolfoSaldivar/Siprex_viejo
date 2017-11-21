


<tbody id="filtro_cambiar">
	<?php foreach ($apus as $key => $apu): ?>
		<tr>
			<td>
				<div class="border_top"></div>
				<?php echo $apu["AnalisisPreciosU"]['clave'] ?>
			</td>
			<td width="500">
				<div class="border_top"></div>
				<?php echo $apu["AnalisisPreciosU"]['descripcion'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<?php echo $apu["AnalisisPreciosU"]['unidad'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<span class="decimal">
					$ <?php echo number_format($apu['AnalisisPreciosU']['total'], 2) ?>
				</span>
			</td>
			<td>
				<a href="/analisis_precios_us/view/<?php echo $apu["AnalisisPreciosU"]['id'] ?>">
					<i class="material-icons">visibility</i>
				</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="/analisis_precios_us/edit/<?php echo $apu["AnalisisPreciosU"]['id'] ?>">
					<i class="material-icons">edit</i>
				</a>
			</td>
		</tr>
	<?php endforeach ?>
</tbody>
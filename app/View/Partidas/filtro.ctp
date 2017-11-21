


<tbody id="filtro_cambiar">
	<?php foreach ($partidas as $key => $partida): ?>
		<tr>
			<td>
				<div class="border_top"></div>
				<?php echo $partida['Partida']['identificador'] ?>
			</td>
			<td width="500">
				<div class="border_top"></div>
				<?php echo $partida['Partida']['nombre'] ?>
			</td>
			<td>
				<div class="border_top"></div>
				<span class="decimal">
					$ <?php echo number_format($partida['Partida']['importe'], 2) ?>
				</span>
			</td>
			<td>
				<a href="/analisis_precios_us/view/<?php echo $partida['Partida']['id'] ?>">
					<i class="material-icons">visibility</i>
				</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="/analisis_precios_us/edit/<?php echo $partida['Partida']['id'] ?>">
					<i class="material-icons">edit</i>
				</a>
			</td>
		</tr>
	<?php endforeach ?>
</tbody>
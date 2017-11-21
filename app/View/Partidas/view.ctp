

<h3>DATOS DE PARTIDA</h3>
<br><br>


<div class="row margin_nada">
	
	<div id="padding_right" class="col s12 m6 l4">
		
		<div id="cambiar_id" class="input-field">
			<input disabled="" value="<?php echo $partida[0]["Partida"]["identificador"] ?>" id="identificador" type="text" name="data[Partida][identificador]">
			<label for="identificador">
				ID
			</label>
		</div>

	</div>

	<div id="padding_right" class="col s12 m6 l4">
		
		<div class="input-field">
			<input disabled="" value="<?php echo $partida[0]["Partida"]["nombre"] ?>" id="nombre" type="text" name="data[Partida][nombre]">
			<label for="nombre">
				NOMBRE
			</label>
		</div>

	</div>
</div>

<table class="tabla_modal">
	<thead>
		<tr>
			<th>APU ID</th>
			<th width="100">
				NÚMERO
			</th>
			<th width="500">
				CONCEPTO
			</th>
			<th width="75" class="center">
				UNIDAD
			</th>
			<th width="125">
				<span class="decimal">P.U.</span>
			</th>
			<th>
				<span class="decimal">CANTIDAD</span>
			</th>
			<th width="125">
				<span class="decimal">IMPORTE</span>
			</th>
			<th></th>
		</tr>
	</thead>

	<tbody id="table_body">

		<?php foreach ($partida[0]["AnalisisPreciosU"] as $key => $apu): ?>
			
			<tr>
				<td>
					<div class="border_top"></div>
					<?php echo $apu["AnalisisPreciosU"]["clave"] ?>
				</td>
				<td>
					<div class="border_top"></div>
					<?php echo $apu["ApuPartida"]["numero"] ?>
				</td>
				<td>
					<div class="border_top"></div>
					<?php echo $apu["AnalisisPreciosU"]["descripcion"] ?>
				</td>
				<td class="center">
					<div class="border_top"></div>
					<?php echo $apu["AnalisisPreciosU"]["unidad"] ?>
				</td>
				<td>
					<div class="border_top"></div>
					<span class="decimal">
						<?php echo number_format($apu["AnalisisPreciosU"]["total"], 2) ?>
					</span>
				</td>
				<td>
					<div class="border_top"></div>
					<span class="decimal">
						<?php echo $apu["ApuPartida"]["cantidad"] ?>
					</span>
				</td>
				<td>
					<div class="border_top"></div>
					<span class="decimal">
						<?php echo
							number_format(
								round($apu["AnalisisPreciosU"]["total"], 2) *
								floatval($apu["ApuPartida"]["cantidad"]),
								2
							);
						?>
					</span>
				</td>
			</tr>

		<?php endforeach ?>

	</tbody>
</table>

<div class="row">
	<div class="col s12 m6 l4 offset-m6 offset-l8">
		<div class="col s6">
			<span class="decimal bold_grande">SUBTOTAL:</span>
		</div>
		<div class="col s6">
			<span id="partida_total" class="decimal bold_grande">
				$ <?php echo number_format($partida[0]["Partida"]["importe"], 2) ?>
			</span>
		</div>
	</div>
</div>

<br><br>


<h3>ANÁLISIS DE PRECIOS UNITARIOS</h3>
<br><br>

<?php echo $this->Form->create(); ?>

	<div class="row">
		
		<div id="padding_right" class="col s12 m4">
			
			<div class="input-field">
				<input disabled id="clave" type="text" value="<?php echo $apu["AnalisisPreciosU"]["clave"] ?>">
				<label for="clave">
					ID
				</label>
			</div>
			
			<div class="input-field">
				<input disabled id="unidad" type="text" value="<?php echo $apu["AnalisisPreciosU"]["unidad"] ?>">
				<label for="unidad">
					UNIDAD
				</label>
			</div>

			<div class="input-field">
				<?php foreach ($partidas as $id => $nombre): ?>
					<?php if ($id == $partida_id): ?>
						<input disabled id="partida" type="text" value="<?php echo $nombre ?>">
						<label for="partida">
							PARTIDA
						</label>
					<?php endif ?>
				<?php endforeach ?>
			</div>
			<br>

		</div>

		<div class="col s12 m8">
			
			<div class="input-field">
				<input disabled id="cantidad" type="number" value="<?php echo $apu["ApuPartida"]["cantidad"] ?>">
				<label for="cantidad">
					CANTIDAD
					<label id="cantidad-error" class="error validation_label" for="cantidad"></label>
				</label>
			</div>

			<div class="input-field">
				<textarea disabled id="descripcion" class="materialize-textarea"></textarea>
				<label for="descripcion" class="textarea_label">
					CONCEPTO
				</label>
			</div>

		</div>



		<table class="tabla_modal">
			<thead>
				<tr>
					<th>ID</th>
					<th>DESCRIPCIÓN</th>
					<th class="center">
						UNIDAD
					</th>
					<th>
						<span class="decimal">PRECIO U.</span>
					</th>
					<th>
						<span class="decimal">CANTIDAD</span>
					</th>
					<th>
						<span class="decimal">TOTAL</span>
					</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($apu["PU"] as $keyP => $pu): ?>

					<tr><td><div class="border_top"></div><span class="white-text">-</span></td><td><div class="border_top"></div><span class="white-text">-</span><b><?php echo $pu["PreciosUnitario"]["nombre"] ?></b></td><td><div class="border_top"></div><span class="white-text">-</span></td><td><div class="border_top"></div><span class="white-text">-</span></td><td><div class="border_top"></div><span class="white-text">-</span></td><td><div class="border_top"></div><span class="white-text">-</span></td></tr>

					<?php foreach ($pu["Insumos"] as $keyI => $insumo): ?>
						
						<tr>
							<td>
								<?php echo $insumo["Insumo"]["identificador"] ?>
							</td>
							<td>
								<?php echo $insumo["Insumo"]["descripcion"] ?>
							</td>
							<td class="center">
								<?php echo $insumo["Insumo"]["unidad"] ?>
							</td>
							<td>
								<span class="decimal">
									<?php echo number_format($insumo["PuInsumo"]["importe"], 2) ?>
								</span>
							</td>
							<td>
								<span class="decimal">
									<?php echo $insumo["PuInsumo"]["cantidad"] ?>
								</span>
							</td>
							<td>
								<span class="decimal">
									<?php echo
										number_format(
											$insumo["PuInsumo"]["cantidad"] *
											$insumo["PuInsumo"]["importe"],
											2
										)
									?>
								</span>
							</td>
						</tr>

					<?php endforeach ?>

					<tr><td></td><td></td><td></td><td></td><td></td><td class="decimal"><b><?php echo number_format($pu["PreciosUnitario"]["total"], 2) ?></b></td></tr>
					
				<?php endforeach ?>

				<tr><td></td></tr>

				<tr>
					<td></td><td></td><td></td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<input disabled="" class="en_modal right-align" value="COSTO DIRECTO">
						</div>
					</td>
					<td>
						<div class="border_top">
						<div class="input-field">
							<input disabled="" class="en_modal right-align white-text" value="-">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<?php
								$costo_directo = $apu["AnalisisPreciosU"]["costo_directo"];
							?>
							<input disabled="" class="en_modal right-align" value="$ <?php echo number_format($costo_directo, 2) ?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td><td></td><td></td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<input disabled="" class="en_modal right-align" value="CARGO INDIRECTO">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<?php
								$p_indirecto = $apu["AnalisisPreciosU"]["costo_indirecto"];
							?>
							<input disabled="" class="en_modal right-align" value="<?php echo $p_indirecto ?> %">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<?php
								$costo_indirecto = $costo_directo * $p_indirecto / 100;
							?>
							<input disabled="" class="en_modal right-align" value="$ <?php echo number_format($costo_indirecto, 2); ?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td><td></td><td></td>
					<td>
						<span class="decimal">SUBTOTAL (1)</span>
					</td><td></td>
					<td>
						<?php
							$subtotal_1 = $costo_directo + $costo_indirecto;
						?>
						<span class="decimal">$ <?php echo number_format($subtotal_1, 2) ?></span>
					</td>
				</tr>
				<tr>
					<td></td><td></td><td></td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<input disabled="" class="en_modal right-align" value="CARGO FINANCIERO">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<?php
								$p_financiero = $apu["AnalisisPreciosU"]["costo_financiero"];
							?>
							<input disabled="" class="en_modal right-align" value="<?php echo $p_financiero ?> %">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<?php
								$costo_financiero = $subtotal_1 * $p_financiero / 100;
							?>
							<input disabled="" class="en_modal right-align" value="$ <?php echo number_format($costo_financiero, 2) ?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td><td></td><td></td>
					<td>
						<span class="decimal">SUBTOTAL (2)</span>
					</td><td></td>
					<td>
						<?php
							$subtotal_2 = $subtotal_1 + $costo_financiero;
						?>
						<span class="decimal">$ <?php echo number_format($subtotal_2, 2) ?></span>
					</td>
				</tr>
				<tr>
					<td></td><td></td><td></td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<input disabled="" class="en_modal right-align" value="CARGO POR UTILIDAD">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<?php
								$p_utilidad = $apu["AnalisisPreciosU"]["costo_utilidad"];
							?>
							<input disabled="" class="en_modal right-align" value="<?php echo $p_utilidad ?> %">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<?php
								$costo_utilidad = $subtotal_2 * $p_utilidad / 100;
							?>
							<input disabled="" id="costo_utilidad" class="en_modal right-align" value="$ <?php echo number_format($costo_utilidad, 2) ?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td><td></td><td></td><td></td>
					<td>
						<span class="decimal bold_grande">PRECIO UNITARIO:</span>
					</td>
					<td>
						<?php
							$gran_total = $subtotal_2 + $costo_utilidad;
						?>
						<span class="decimal bold_grande">$ <?php echo number_format($gran_total, 2) ?></span>
					</td>
				</tr>
			</tbody>
		</table>

		<br>

		<!-- <button id="imprimir" class="right btn waves-effect waves-black">
			Imprimir
		</button> -->

		<br><br>

	</div>

<?php echo $this->Form->end(); ?>



<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$(document).ready(function() {
		$('#descripcion').val('<?php echo $apu["AnalisisPreciosU"]["descripcion"] ?>');
  		$('#descripcion').trigger('autoresize');
	});

	$("#imprimir").click(function(){
		window.print();
	});

<?php $this->Html->scriptEnd(); ?>
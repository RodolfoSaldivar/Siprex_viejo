

<h4>DATOS DE PRESUPUESTO</h4>
<br><br>

<div class="row margin_nada">
	
	<div id="padding_right" class="col s12 m6">
		
		<div class="input-field">
			<input disabled="" id="obra" type="text" name="data[Presupuesto][obra]" value="<?php echo $presupuesto["Presupuesto"]["obra"] ?>">
			<label for="obra">
				OBRA
			</label>
		</div>
		
		<div class="input-field">
			<input disabled="" id="ubicacion" type="text" name="data[Presupuesto][ubicacion]" value="<?php echo $presupuesto["Presupuesto"]["ubicacion"] ?>">
			<label for="ubicacion">
				UBICACIÓN
			</label>
		</div>
		
		<div class="input-field">
			<input disabled="" id="colonia" type="text" name="data[Presupuesto][colonia]" value="<?php echo $presupuesto["Presupuesto"]["colonia"] ?>">
			<label for="colonia">
				COLONIA
			</label>
		</div>

	</div>

	<div id="padding_left" class="col s12 m6">
			
		<div class="input-field">
			<input disabled="" id="contratista" type="text" name="data[Presupuesto][contratista]" value="<?php echo $presupuesto["Presupuesto"]["contratista"] ?>">
			<label for="contratista">
				CONTRATISTA
				<label id="contratista-error" class="error validation_label" for="contratista"></label>
			</label>
		</div>

	</div>
</div>


<div class="row">
	<div class="col s12">
		<table>
			<thead>
				<tr class="row">
					<th class="col s3">ID PARTIDA</th>
					<th class="col s3 center">PARTIDA</th>
					<th class="col s3 center">SUBTOTAL</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<ul class="collapsible" data-collapsible="expandable">
	<?php foreach ($presupuesto["Partidas"] as $keyP => $partida): ?>
	<?php if ($partida["Partida"]["importe"]): ?>

		<li>
			<div id="collapsible_conceptos" class="collapsible-header active">
				<div class="row margin_nada">
					<div class="col s3">
						<div class="border_top"></div>
						<?php echo $partida['Partida']['identificador'] ?>
					</div>
					<div class="col s3 center">
						<div class="border_top"></div>
						<?php echo $partida['Partida']['nombre'] ?>
					</div>
					<div class="col s3">
						<div class="border_top"></div>
						<span class="decimal" id="partida_span_<?php echo $keyP ?>">
							$ <?php echo number_format($partida['Partida']['importe'], 2) ?>
						</span>
					</div>
				</div>
			</div>
			<div class="collapsible-body padding_nada">
				<table>
					<thead>
						<tr>
							<th>ID CONCEPTO</th>
							<th width="400">CONCEPTO</th>
							<th>UNIDAD</th>
							<th class="right-align">P.U.</th>
							<th class="center">CANTIDAD</th>
							<th class="right-align">IMPORTE</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($partida["AnalisisPreciosU"] as $keyAPU => $apu): ?>
							<?php if ($apu["AnalisisPreciosU"]["activo"]): ?>
								
								<tr>
									<td><?php echo $apu["AnalisisPreciosU"]["clave"] ?></td>
									<td width="400"><?php echo $apu["AnalisisPreciosU"]["descripcion"] ?></td>
									<td><?php echo $apu["AnalisisPreciosU"]["unidad"] ?></td>
									<td class="right-align"><?php echo $apu["AnalisisPreciosU"]["importe"] ?></td>
									<td class="center"><?php echo $apu["ApuPartida"]["cantidad"] ?></td>
									<td class="right-align">
										<?php $importe_apu = $apu["AnalisisPreciosU"]["importe"] * $apu["ApuPartida"]["cantidad"]; ?>
										$ <?php echo number_format($importe_apu, 2) ?>
									</td>
								</tr>
								
							<?php endif ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</li>
		
	<?php endif ?>
	<?php endforeach ?>
</ul>
<br><br>

<div class="row">
	<div class="col s12 m6 l4 offset-m6 offset-l8">
		<div class="border_top margin_bottom"></div>
		<div class="col s6">
			<span class="decimal">TOTAL:</span>
		</div>
		<div class="col s6">
			<span id="total" class="decimal">
				$ <?php echo number_format($presupuesto["Presupuesto"]["importe"], 2) ?>
			</span>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12 m6 l4 offset-m6 offset-l8">
		<div class="col s6">
			<span class="decimal">IVA(16%):</span>
		</div>
		<div class="col s6">
			<span id="iva" class="decimal">
				$ <?php echo number_format($presupuesto["Presupuesto"]["importe"]*0.16, 2) ?>
			</span>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12 m6 l4 offset-m6 offset-l8">
		<div class="border_top margin_bottom"></div>
		<div class="col s6">
			<span class="decimal bold_grande">GRAN TOTAL:</span>
		</div>
		<div class="col s6">
			<span id="gran_total" class="decimal bold_grande">
				$ <?php echo number_format($presupuesto["Presupuesto"]["importe"]*1.16, 2) ?>
			</span>
		</div>
	</div>
</div>

<br><br><br><br>




<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$("#opcion_presupuestos").addClass("opcion_seleccionada");
	$("#bread_presupuesto_nombre").addClass("hide");

<?php $this->Html->scriptEnd(); ?>
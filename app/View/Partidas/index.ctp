

<div class="row margin_nada">
	<div class="col s12 m6">
		<h4>
			CONCEPTOS
			<a href="/analisis_precios_us/add" class="btn-floating btn-large waves-effect waves-light">
				<i class="material-icons">add</i>
			</a>
		</h4>
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
	<?php foreach ($partidas as $keyP => $partida): ?>
		<?php if ($partida["AnalisisPreciosU"]): ?>
			
			<li>
				<div id="collapsible_conceptos" class="collapsible-header">
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
							<input type="hidden" id="partida_importe_<?php echo $keyP ?>" value="<?php echo $partida['Partida']['importe'] ?>">
						</div>
						<div class="col s1">
							<a href="/partidas/edit/<?php echo $partida['Partida']['id'] ?>">
								<i class="material-icons">edit</i>
							</a>
						</div>
					</div>
				</div>
				<div class="collapsible-body padding_nada">
					<table>
						<thead>
							<tr>
								<th></th>
								<th>ID CONCEPTO</th>
								<th width="400">CONCEPTO</th>
								<th>UNIDAD</th>
								<th class="right-align">P.U.</th>
								<th class="center">CANTIDAD</th>
								<th class="right-align">IMPORTE</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($partida["AnalisisPreciosU"] as $keyAPU => $apu): ?>
								<?php $id = $apu["AnalisisPreciosU"]["id"]; ?>
								<tr>
									<td>
										<?php if ($apu["AnalisisPreciosU"]["activo"]): ?>
											<input type="checkbox" id="check_<?php echo $id ?>" onchange="clickCheckbox('<?php echo $id ?>', <?php echo $keyP ?>)" checked="" />
										<?php else: ?>
											<input type="checkbox" id="check_<?php echo $id ?>" onchange="clickCheckbox('<?php echo $id ?>', <?php echo $keyP ?>)" />
										<?php endif ?>
	      								<label for="check_<?php echo $id ?>"></label>
									</td>
									<td><?php echo $apu["AnalisisPreciosU"]["clave"] ?></td>
									<td width="400"><?php echo $apu["AnalisisPreciosU"]["descripcion"] ?></td>
									<td><?php echo $apu["AnalisisPreciosU"]["unidad"] ?></td>
									<td class="right-align"><?php echo $apu["AnalisisPreciosU"]["importe"] ?></td>
									<td class="center"><?php echo $apu["ApuPartida"]["cantidad"] ?></td>
									<td class="right-align">
										<?php $importe_apu = $apu["AnalisisPreciosU"]["importe"] * $apu["ApuPartida"]["cantidad"]; ?>
										$ <?php echo number_format($importe_apu, 2) ?>
										<input type="hidden" id="apu_importe_<?php echo $id ?>" value="<?php echo $importe_apu ?>">
									</td>
									<td>
										<a href="/analisis_precios_us/view/<?php echo $apu['AnalisisPreciosU']['id'] ?>">
											<i class="material-icons">visibility</i>
										</a>
										<br>
										<a href="/analisis_precios_us/edit/<?php echo $apu['AnalisisPreciosU']['id'] ?>">
											<i class="material-icons">edit</i>
										</a>
										<br>
										<a href="/analisis_precios_us/download/<?php echo $apu['AnalisisPreciosU']['id'] ?>" target="_blank">
											<i class="material-icons">file_download</i>
										</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</li>
			
		<?php endif ?>
	<?php endforeach ?>
</ul>
<br><br>



<?php $this->Html->script('number_format.min', array('inline' => false)); ?>

<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$("#opcion_conceptos").addClass("opcion_seleccionada");

	function clickCheckbox(id, keyP)
	{
		var el_check = $("#check_"+id);
		var estatus = 0;

		if (el_check.prop("checked"))
		{
			estatus = 1;
		}
		else
		{
			estatus = 0;
		}

		activarDesactivar(id, estatus);
		actualizarPrecioPartida(id, keyP, estatus);
	}

	function activarDesactivar(id, estatus)
	{
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '/analisis_precios_us/activar_desactivar',
	        success: function(response)
	        {

	        },
	        data: {
	        	id: id,
	        	estatus: estatus
	        }
	    });
	}

	function actualizarPrecioPartida(id, keyP, estatus)
	{
		var importe_partida = $("#partida_importe_"+keyP).val();
		var importe_apu = $("#apu_importe_"+id).val();

		importe_partida = regresarFloat(importe_partida);
		importe_apu = regresarFloat(importe_apu);

		if (estatus)
			importe_partida+= importe_apu;
		else
			importe_partida-= importe_apu;

		$("#partida_importe_"+keyP).val(importe_partida);
		importe_partida = $.number(importe_partida, 2);
		$("#partida_span_"+keyP).text("$ "+importe_partida);
	}

<?php $this->Html->scriptEnd(); ?>


<h4>ANÁLISIS DE PRECIOS UNITARIOS</h4>
<br><br>

<?php echo $this->Form->create(); ?>

	<?php echo $this->Form->hidden('id', array('value' => $apu['AnalisisPreciosU']['id'], 'name' => 'data[APU][id]')); ?>

	<div class="row">
		
		<div id="padding_right" class="col s12 m4">
			
			<div id="cambiar_clave" class="input-field">
				<input id="clave" type="text" name="data[APU][clave]" value="<?php echo $apu["AnalisisPreciosU"]["clave"] ?>">
				<label for="clave">
					ID
					<label id="clave-error" class="error validation_label" for="clave"></label>
				</label>
			</div>
			
			<div class="input-field">
				<input id="unidad" type="text" name="data[APU][unidad]" value="<?php echo $apu["AnalisisPreciosU"]["unidad"] ?>">
				<label for="unidad">
					UNIDAD
					<label id="unidad-error" class="error validation_label" for="unidad"></label>
				</label>
			</div>

			<div class="input-field">
				<select name="data[ApuPartida][partida_id]" id="partida">
					<?php foreach ($partidas as $id => $nombre): ?>
						<?php if ($id == $partida_id): ?>
							<option selected value="<?php echo $id ?>"><?php echo $nombre ?></option>
						<?php else: ?>
							<option value="<?php echo $id ?>"><?php echo $nombre ?></option>
						<?php endif ?>
					<?php endforeach ?>
				</select>
				<label for="partida">PARTIDA</label>
			</div>
			<br>

		</div>

		<div class="col s12 m8">
			
			<div class="input-field">
				<input id="cantidad" type="number" name="data[ApuPartida][cantidad]" value="<?php echo $apu["ApuPartida"]["cantidad"] ?>">
				<label for="cantidad">
					CANTIDAD
					<label id="cantidad-error" class="error validation_label" for="cantidad"></label>
				</label>
			</div>

			<div class="input-field">
				<label for="descripcion" class="textarea_label">
					CONCEPTO
					<label id="descripcion-error" class="error validation_label" for="descripcion"></label>
				</label>
				<textarea id="descripcion" class="materialize-textarea" name="data[APU][descripcion]"></textarea>
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
					<th></th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($apu["PU"] as $keyP => $pu): ?>

					<?php $cont_pu = $keyP; ?>

					<tr class="categoria_<?php echo $keyP; ?>"><td><div class="border_top"></div><span class="white-text">-</span></td>
					<td>
						<div class="border_top"></div>
						<span class="">
							<input class="en_modal para_escribir" type="text" name="data[PU][<?php echo $keyP ?>][nombre]" value="<?php echo $pu["PreciosUnitario"]["nombre"] ?>">
							<label id="data[PU][<?php echo $keyP ?>][nombre]-error" class="error validation_label" for="data[PU][<?php echo $keyP ?>][nombre]"></label>
						</span>
					</td>
					<td><div class="border_top"></div><span class="white-text">-</span></td><td><div class="border_top"></div><span class="white-text">-</span></td><td><div class="border_top"></div><span class="white-text">-</span></td><td><div class="border_top"></div><span class="white-text">-</span></td>
					<td>
						<a id="remover_todo_<?php echo $keyP; ?>" class="btn-floating btn-large waves-effect waves-light white btn_border"><i class="material-icons">close</i></a>
					</td>
					</tr>

					<?php foreach ($pu["Insumos"] as $keyI => $insumo): ?>
						
						<tr id="tr_<?php echo $keyP."_".$keyI; ?>" class="categoria_<?php echo $keyP; ?>">
							<input type="hidden" id="hidden_<?php echo $keyP."_".$keyI; ?>" name="data[PU][<?php echo $keyP ?>][Insumos][<?php echo $insumo["Insumo"]["identificador"] ?>]" value="<?php echo $insumo["PuInsumo"]["cantidad"] ?>">
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
								<span class="decimal" id="precio_<?php echo $keyP."_".$keyI; ?>">
									<?php echo number_format($insumo["PuInsumo"]["importe"], 2) ?>
								</span>
							</td>
							<td>
								<span class="">
									<input id="cantidad_<?php echo $keyP."_".$keyI; ?>" class="en_modal right-align para_escribir" type="number" value="<?php echo @$insumo["PuInsumo"]["cantidad"] ?>">
								</span>
							</td>
							<td>
								<span class="decimal" id="total_<?php echo $keyP."_".$keyI; ?>">
									<?php echo
										number_format(
											$insumo["PuInsumo"]["cantidad"] *
											$insumo["PuInsumo"]["importe"],
											2
										)
									?>
								</span>
							</td>
							<td>
								<a id="remover_<?php echo $keyP."_".$keyI; ?>" class="btn-floating waves-effect waves-light white btn_border btn_peque"><i class="material-icons">remove</i></a>
							</td>
						</tr>

					<?php endforeach ?>

					<tr id="antes_<?php echo $keyP ?>" class="categoria_<?php echo $keyP; ?>"><td></td>
					<td>
						<a id="agregar_insumo_<?php echo $keyP; ?>" class="btn-floating btn-small waves-effect waves-black white btn_border"><i class="material-icons">add</i></a>
					</td>
					<td></td><td></td><td></td>
					<td class="decimal"><b id="pu_total_<?php echo $keyP; ?>">
						<?php echo number_format($pu["PreciosUnitario"]["total"], 2) ?></b>
					</td></tr>
					
				<?php endforeach ?>

				<tr id="poner_antes">
					<td></td>
					<td>
						<a id="btn_modal_apu" class="modal-trigger waves-effect waves-black btn parpadea" href="#pu_modal">Agregar</a>
					</td>
					<td></td><td></td><td></td><td></td>
				</tr>

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
							<input disabled="" id="apu_subtotal" class="en_modal right-align" value="$ <?php echo number_format($costo_directo, 2) ?>">
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
							<input type="number" id="indirecto_p" class="en_modal para_escribir right-align" name="data[APU][costo_indirecto]" value="<?php echo $p_indirecto ?>">%
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<?php
								$costo_indirecto = $costo_directo * $p_indirecto / 100;
							?>
							<input disabled="" id="costo_indirecto" class="en_modal right-align" value="$ <?php echo number_format($costo_indirecto, 2); ?>">
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
						<span id="subtotal_1" class="decimal">$ <?php echo number_format($subtotal_1, 2) ?></span>
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
							<input type="number" id="financiero_p" class="en_modal para_escribir right-align" name="data[APU][costo_financiero]" value="<?php echo $p_financiero ?>">%
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<?php
								$costo_financiero = $subtotal_1 * $p_financiero / 100;
							?>
							<input disabled="" id="costo_financiero" class="en_modal right-align" value="$ <?php echo number_format($costo_financiero, 2) ?>">
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
						<span id="subtotal_2" class="decimal">$ <?php echo number_format($subtotal_2, 2) ?></span>
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
							<input type="number" id="utilidad_p" class="en_modal para_escribir right-align" name="data[APU][costo_utilidad]" value="<?php echo $p_utilidad ?>">%
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
						<span id="apu_total" class="decimal bold_grande">$ <?php echo number_format($gran_total, 2) ?></span>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="col m11">
			<button class="right btn waves-effect waves-black" type="submit" name="action">
				Actualizar Precios y Terminar
			</button>
		</div>

		<br><br><br><br>

	</div>

<?php echo $this->Form->end(); ?>




<div id="pu_modal" class="modal">

	<div class="modal-content">
		<h5>AGREGAR CATEGORÍA</h5>
		<br>
		<div class="row margin_nada">	
			<div class="input-field col s12 m6">
				<input id="nombre" type="text">
				<label for="nombre">
					NOMBRE
					<label id="nombre-error" class="validation_label" for="nombre">* Requerido</label>
				</label>
			</div>
		</div>

		<table class="tabla_modal">
			<thead>
				<tr>
					<th>INSUMO ID</th>
					<th>DESCRIPCIÓN</th>
					<th class="center">
						UNIDAD
					</th>
					<th>
						<span class="decimal">PRECIO VENTA</span>
					</th>
					<th>
						<span class="decimal">CANTIDAD</span>
					</th>
					<th>
						<span class="decimal">PRECIO U</span>
					</th>
				</tr>
			</thead>

			<tbody id="table_body">
				<tr id="tr_1">
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<input class="en_modal para_escribir" id="insumo_1" type="text" placeholder="Escribir ID">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<input disabled="" id="modal_descripcion_1" class="en_modal" value="">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<input disabled="" id="modal_unidad_1" class="en_modal center" value="">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<input disabled="" id="modal_precio_venta_1" class="en_modal center" value="">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<input disabled="" id="modal_cantidad_1" class="en_modal right-align" value="">
						</div>
					</td>
					<td>
						<div class="border_top"></div>
						<div class="input-field">
							<input disabled="" id="modal_precio_1" class="en_modal right-align" value="">
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<a id="agregar_insumo" class="btn-floating btn-small waves-effect waves-black white btn_border"><i class="material-icons">add</i></a>
	</div>

	<div class="modal-footer">
		<a id="modal_cancelar" class="modal-action modal-close waves-effect waves-black btn-flat ">Cancelar</a>
		<a id="modal_aceptar" class="modal-action waves-effect waves-black btn-flat ">Aceptar</a>
	</div>
</div>



<?php $this->Html->script('donetyping', array('inline' => false)); ?>
<?php $this->Html->script('number_format.min', array('inline' => false)); ?>
<?php $this->Html->script('apu_agregar_editar', array('inline' => false)); ?>


<?php $this->Html->scriptStart(array('inline' => false)); ?>


	$(document).ready(function() {
		$('select').material_select();
		$('#descripcion').val('<?php echo $apu["AnalisisPreciosU"]["descripcion"] ?>');
  		$('#descripcion').trigger('autoresize');
	});

	<?php if (empty($cont_pu)): ?>
		var cont_pu = 1;
	<?php else: ?>
		var cont_pu = <?php echo $cont_pu + 1; ?>;
	<?php endif ?>

	$("#opcion_apu").addClass("opcion_seleccionada");



	<?php
		//Validar los inputs
	?>

	$('#AnalisisPreciosUEditForm').submit(function()
	{
		var valido = true;

		$(".des_lleno").each(function()
		{
			if ($(this).val() == "")
			{
				var input = $(this).parent().parent().parent().find(".soy_id");

				$(input).val("");
				$(input).attr("placeholder", "* Requerido");
				$(input).addClass("border_rojo");

				valido = false;
			}
		})

		return valido;
	});

	$('#AnalisisPreciosUEditForm').validate({
		rules: {
			<?php foreach ($apu["PU"] as $keyP => $pu): ?>

				'data[PU][<?php echo $keyP ?>][nombre]': {
					required: true,
					alphanumeric: true,
					maxlength: 50
				},

			<?php endforeach ?>
			'data[APU][clave]': {
				required: true,
				alphanumeric: true,
				maxlength: 50
			},
			'data[APU][descripcion]': {
				required: true,
				alphanumeric: true,
				maxlength: 1500
			},
			'data[APU][unidad]': {
				required: true,
				alphanumeric: true,
				maxlength: 50
			},
			'data[ApuPartida][cantidad]': {
				required: true,
				alphanumeric: true,
				min: 0
			}
		}
	});




	
	<?php
		//Cada vez que escribe en el nombre del Precio Unitario
	?>

	$("#nombre").donetyping(function()
	{
		var valido = !<?php echo $regex ?>.test($(this).val());

		if (valido)
			$("#nombre-error").css("display", "none");
		else
		{
			$("#nombre-error").text("*Solo letras y números");
			$(this).val("");
			$(this).focus();
		}
	});




	<?php
		//Revisa que la clave no se repita
	?>

	$('#clave').donetyping(function()
	{ revisarClave(); });

	function revisarClave()
	{
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '/analisis_precios_us/revisar_clave',
	        success: function(response)
	        {
	            $('#cambiar_clave').replaceWith(response);

	            var poner_focus = $("#clave");
				var length_texto = poner_focus.val().length;
				poner_focus.focus();
				poner_focus[0].setSelectionRange(length_texto, length_texto);

	            $('#clave').donetyping(function()
				{ revisarClave(); });
	        },
	        data: {
	        	nueva_clave: $('#clave').val(),
	        	clave_actual: '<?php echo $apu["AnalisisPreciosU"]["clave"] ?>',
	        	url: "edit"
	        }
	    });
	}





	<?php 
		//Validar todas las cantidades, que se quiten los tr y que se actualice el precio
	?>

	var cif = [];

	<?php foreach ($apu["PU"] as $keyP => $pu): ?>

		cif[<?php echo $keyP ?>] = 0;

		<?php foreach ($pu["Insumos"] as $keyI => $insumo): ?>

			cif[<?php echo $keyP ?>] = <?php echo $keyI ?>;

			$(document).on("keyup paste change", "#cantidad_<?php echo $keyP."_".$keyI; ?>", function(){
				validarCantidad('<?php echo $keyP; ?>', '<?php echo $keyI; ?>');
			});

			$(document).on("click", "#remover_<?php echo $keyP."_".$keyI; ?>", function(){
				removerFila('<?php echo $keyP; ?>', '<?php echo $keyI; ?>');
			});
			
		<?php endforeach ?>

		<?php 
			//Cuando le da click al boton de agregar insumo, fuera del modal
		?>

		$(document).on("click", "#agregar_insumo_<?php echo $keyP; ?>", function(){
			validarAgregarInsumo('<?php echo $keyP; ?>');
		});

		<?php 
			//Cuando le da click al boton de remover todo, fuera del modal
		?>

		$(document).on("click", "#remover_todo_<?php echo $keyP; ?>", function(){
			removerTodo('<?php echo $keyP; ?>');
		});

	<?php endforeach ?>


	function validarCantidad(keyP, keyI)
	{
		var cantidad = $("#cantidad_"+keyP+"_"+keyI).val();

		if (cantidad >= 0)
		{
			cantidad = regresarFloat(cantidad);
			$("#hidden_"+keyP+"_"+keyI).val(cantidad);

			var total_actual = $("#total_"+keyP+"_"+keyI).text();
			total_actual = regresarFloat(total_actual);
			
			var precio = $("#precio_"+keyP+"_"+keyI).text();
			precio = regresarFloat(precio);

			var total_nuevo = $.number(precio * cantidad, 2);

			$("#total_"+keyP+"_"+keyI).text(total_nuevo);
			total_nuevo = regresarFloat(total_nuevo);

			var precio_pu = $("#pu_total_"+keyP).text();
			precio_pu = regresarFloat(precio_pu);

			var pu_resultante = precio_pu + (total_nuevo - total_actual);
			pu_resultante = $.number(pu_resultante, 2);
			$("#pu_total_"+keyP).text(pu_resultante);

			actualizarCostoDirecto(total_nuevo - total_actual);
		}
		else
			$("#cantidad_"+keyP+"_"+keyI).val("0");
	}

	function validarCantidadNueva(keyP, keyI)
	{
		var cantidad = $("#cantidad_"+keyP+"_"+keyI).val();
		cantidad = regresarFloat(cantidad);
		$("#hidden_"+keyP+"_"+keyI).val(cantidad);

		var total_actual = $("#total_"+keyP+"_"+keyI).text();
		total_actual = regresarFloat(total_actual);

		var precio_pu = $("#pu_total_"+keyP).text();
		precio_pu = regresarFloat(precio_pu);

		var pu_resultante = precio_pu + total_actual;
		pu_resultante = $.number(pu_resultante, 2);
		$("#pu_total_"+keyP).text(pu_resultante);

		actualizarCostoDirecto(total_actual);
	}

	function removerFila(keyP, keyI)
	{
		removerPrecioPu(keyP, keyI);

		$("#tr_"+keyP+"_"+keyI).remove();
	}

	function removerPrecioPu(keyP, keyI)
	{
		var total_actual = $("#total_"+keyP+"_"+keyI).text();
		total_actual = regresarFloat(total_actual);

		var precio_pu = $("#pu_total_"+keyP).text();
		precio_pu = regresarFloat(precio_pu);

		var pu_resultante = precio_pu - total_actual;
		pu_resultante = $.number(pu_resultante, 2);
		$("#pu_total_"+keyP).text(pu_resultante);

		if (total_actual)
			actualizarCostoDirecto(-total_actual);
	}

	function removerTodo(keyP)
	{
		var precio_pu = $("#pu_total_"+keyP).text();
		precio_pu = regresarFloat(precio_pu);

		actualizarCostoDirecto(-precio_pu);

		$(".categoria_"+keyP).remove();
	}

	function validarAgregarInsumo(keyP)
	{
		var todo_lleno = true;

		if ($('#descripcion_'+keyP+'_'+cif[keyP]).val() == "")
		{
			$('#insumo_'+keyP+'_'+cif[keyP]).val("");
			$('#insumo_'+keyP+'_'+cif[keyP]).attr("placeholder", "* Requerido");
			$('#insumo_'+keyP+'_'+cif[keyP]).addClass("border_rojo");
			todo_lleno = false;
		}
		
		if ($('#cantidad_'+keyP+'_'+cif[keyP]).val() == "")
		{
			$('#cantidad_'+keyP+'_'+cif[keyP]).addClass("border_rojo");
			todo_lleno = false;
		}

		if (todo_lleno)
			agregarInsumoFuera(keyP);
	}

	function agregarInsumoFuera(keyP)
	{
		cif[keyP] = cif[keyP] + 1;
		var igual_keyP = keyP;
		var igual_keyI = cif[igual_keyP];
		
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '/analisis_precios_us/agregar_insumo_fuera',
	        success: function(response)
	        {
	            $(response).insertBefore("#antes_"+keyP);
	            $('#insumo_'+igual_keyP+'_'+igual_keyI).donetyping(function(){
					traerInfoFuera(igual_keyP, igual_keyI);
				});
				$(document).on("click", '#remover_'+igual_keyP+'_'+igual_keyI, function(){
					removerFila(igual_keyP, igual_keyI);
				});
	        },
	        data: {
	        	keyP: igual_keyP,
	        	keyI: igual_keyI
	        }
	    });
	}

	function traerInfoFuera(keyP, keyI)
	{
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '/insumos/traer_info_fuera',
	        success: function(response)
	        {
	            $("#tr_"+keyP+"_"+keyI).replaceWith(response);

	            $('#insumo_'+keyP+"_"+keyI).donetyping(function(){
	            	removerPrecioPu(keyP, keyI);
					traerInfoFuera(keyP, keyI);
				});
				$(document).on("keyup paste change", "#cantidad_"+keyP+"_"+keyI, function(){
					validarCantidad(keyP, keyI);
				});
				var poner_focus = $('#insumo_'+keyP+"_"+keyI);
				var length_texto = poner_focus.val().length;
				poner_focus.focus();
				poner_focus[0].setSelectionRange(length_texto, length_texto);

				validarCantidadNueva(keyP, keyI);			
	        },
	        data: {
	        	id: $('#insumo_'+keyP+"_"+keyI).val(),
	        	keyP: keyP,
	        	keyI: keyI
	        }
	    });
	}


<?php $this->Html->scriptEnd(); ?>
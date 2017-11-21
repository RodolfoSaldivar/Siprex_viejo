


<tr id="tr_<?php echo $cont_partida; ?>">
	<input type="hidden" id="hidden_<?php echo $cont_partida; ?>" name="data[Partida][<?php echo $cont_partida ?>][identificador]" value="">
	<td>
		<div class="border_top"></div>
		<input class="en_modal para_escribir soy_id" id="partida_<?php echo $cont_partida; ?>" placeholder="Escribir ID" type="text">
	</td>
	<td>
		<div class="border_top"></div>
		<input class="en_modal para_escribir todos_numeros" id="numero_<?php echo $cont_partida; ?>" name="data[Partida][<?php echo $cont_partida ?>][numero]" value="" type="text">
	</td>
	<td>
		<div class="border_top"></div>
		<input disabled="" class="en_modal" id="nombre_<?php echo $cont_partida; ?>" value="">
	</td>
	<td>
		<div class="border_top"></div>
		<input disabled="" class="en_modal right-align" id="importe_<?php echo $cont_partida; ?>" value="0.00">
	</td>
	<td class="center">
		<a id="remover_<?php echo $cont_partida; ?>" class="btn-floating waves-effect waves-light white btn_border btn_peque">
			<i class="material-icons">remove</i>
		</a>
	</td>
</tr>
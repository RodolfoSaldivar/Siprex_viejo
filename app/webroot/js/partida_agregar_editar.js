//Revisa que el ID del apu no se repita

function revisarPartidaApu(igual_a_apu)
{
	$.ajax({
        type:'POST',
        cache: false,
        url: '/analisis_precios_us/revisar_partida_apu',
        success: function(response)
        {
            $("#apu_"+igual_a_apu).replaceWith(response);

            var poner_focus = $("#apu_"+igual_a_apu);
			var length_texto = poner_focus.val().length;
			poner_focus.focus();
			poner_focus[0].setSelectionRange(length_texto, length_texto);

            $("#apu_"+igual_a_apu).donetyping(function(){
            	revisarPartidaApu(igual_a_apu);
            });
        },
        data: {
        	nueva_clave: $("#apu_"+igual_a_apu).val(),
        	cont_apu: igual_a_apu
        }
    });
}





//Ajax para agregar APU con id existente

$(document).on("click", "#apu_existente", function()
{
	if (cont_apu != 0)
	{
		var todo_lleno = true;
		
		if (todo_lleno) todo_lleno = ultimaLlena();

		if (todo_lleno) todo_lleno = validarNuevosCampos();

		if (todo_lleno)
			agregarApuExistente();
	}
	else
		agregarApuExistente();
})

function agregarApuExistente()
{
	cont_apu++;
	var igual_a_apu = cont_apu;

	$.ajax({
        type:'POST',
        cache: false,
        url: '/partidas/agregar_existente',
        success: function(response)
        {
            $("#table_body").append(response);

            $('#apu_'+igual_a_apu).donetyping(function(){
				traerInfoApu(igual_a_apu);
			});

            $(document).on("keyup paste change", "#cantidad_"+igual_a_apu, function(){
				validarCantidad(igual_a_apu);
			});

            $(document).on("click", "#remover_"+igual_a_apu, function(){
				removerFila(igual_a_apu);
			});

			$(document).on("keyup paste change", "#numero_"+igual_a_apu, function(){
				yaEsValido($(this));
			})
        },
        data: {
        	cont_apu: igual_a_apu
        }
    });
}





//Ajax para agregar APUs nuevos

$(document).on("click", "#apu_nuevo", function()
{
	if (cont_apu != 0)
	{
		var todo_lleno = true;
		
		if (todo_lleno) todo_lleno = ultimaLlena();

		if (todo_lleno) todo_lleno = validarNuevosCampos();

		if (todo_lleno)
			agregarApuNuevo();
	}
	else
		agregarApuNuevo();
})

function agregarApuNuevo()
{
	cont_apu++;
	var igual_a_apu = cont_apu;

	$.ajax({
        type:'POST',
        cache: false,
        url: '/partidas/agregar_nuevo',
        success: function(response)
        {
            $("#table_body").append(response);

            $(document).on("click", "#remover_"+igual_a_apu, function(){
				removerFila(igual_a_apu);
			});

            $("#apu_"+igual_a_apu).donetyping(function(){
            	revisarPartidaApu(igual_a_apu);
            });

			$(document).on("keyup paste change", "#apu_"+igual_a_apu, function(){
				yaEsValido($(this));
			})

			$(document).on("keyup paste change", "#numero_"+igual_a_apu, function(){
				yaEsValido($(this));
			})

			$(document).on("keyup paste change", "#descripcion_"+igual_a_apu, function(){
				yaEsValido($(this));
			})

			$(document).on("keyup paste change", "#unidad_"+igual_a_apu, function(){
				yaEsValido($(this));
			})

			$(document).on("keyup paste change", "#cantidad_"+igual_a_apu, function(){
				yaEsValido($(this));
				validarCantidad(igual_a_apu);
			})
        },
        data: {
        	cont_apu: igual_a_apu
        }
    });
}





//Traer info de APU

function traerInfoApu(cont_apu)
{
	$.ajax({
        type:'POST',
        cache: false,
        url: '/analisis_precios_us/traer_info_apu',
        success: function(response)
        {
			actualizarPartidaSubtotal(-1*regresarFloat($("#importe_"+cont_apu).val()));

            $("#tr_"+cont_apu).replaceWith(response);

            $('#apu_'+cont_apu).donetyping(function(){
				traerInfoApu(cont_apu);
			});
			$(document).on("keyup paste change", "#cantidad_"+cont_apu, function(){
				validarCantidad(cont_apu);
			});

			var poner_focus = $('#apu_'+cont_apu);
			var length_texto = poner_focus.val().length;
			poner_focus.focus();
			poner_focus[0].setSelectionRange(length_texto, length_texto);	

			actualizarPartidaSubtotal(regresarFloat($("#importe_"+cont_apu).val()));	
        },
        data: {
        	clave: $('#apu_'+cont_apu).val(),
        	cont_apu: cont_apu
        }
    });
}





//Validar que cantidad sea mínimo 0

function validarCantidad(cont_apu)
{
	var cantidad = $("#cantidad_"+cont_apu).val();

	if (cantidad < 0)
		$("#cantidad_"+cont_apu).val("0");
	else
	{
		if ($("#pu_"+cont_apu).val() != "")
		{
			cantidad = regresarFloat(cantidad);

			var precio = $("#pu_"+cont_apu).val();
			precio = regresarFloat(precio);

			var importe_actual = $("#importe_"+cont_apu).val();
			importe_actual = regresarFloat(importe_actual);

			var importe_nuevo = $.number(precio * cantidad, 2);
			$("#importe_"+cont_apu).val(importe_nuevo);
			importe_nuevo = regresarFloat(importe_nuevo);

			actualizarPartidaSubtotal(importe_nuevo - importe_actual);
		}
	}
}





//Actualiza el subtotal de la partida

function actualizarPartidaSubtotal(importe)
{
	var subtotal_actual = $("#partida_total").text().substring(2);
	subtotal_actual = regresarFloat(subtotal_actual);

	var subtotal_nuevo = subtotal_actual + importe;
	subtotal_nuevo = (subtotal_nuevo).toFixed(2);

	$("#partida_total").text("$ "+$.number(subtotal_nuevo, 2));
}





//Cuando quita una fila

function removerFila(cont_apu)
{
	actualizarPartidaSubtotal(-1*regresarFloat($("#importe_"+cont_apu).val()));

	$("#tr_"+cont_apu).remove();
}





//Remueve el placeholder y elborde rojo

function yaEsValido(input)
{
	$(input).removeAttr("placeholder");
	$(input).removeClass("border_rojo");
}





//Valida que los nuevos APUs esten llenos

function validarNuevosCampos()
{
	valido = true;

	$(".campos_nuevos").each(function()
	{
		if ($(this).val() == "")
		{
			$(this).val("");
			$(this).attr("placeholder", "* Requerido");
			$(this).addClass("border_rojo");

			valido = false;
		}
	})

	return valido;
}





//Valida que los numeros esten todos llenos

function numerosLlenos()
{
	valido = true;

	$(".todos_numeros").each(function()
	{
		if ($(this).val() == "")
		{
			$(this).val("");
			$(this).attr("placeholder", "* Requerido");
			$(this).addClass("border_rojo");

			valido = false;
		}
	})

	return valido;
}





//Valida que las unidades esten todas llenas

function unidadesLlenas()
{
	valido = true;

	$(".todas_unidad").each(function()
	{
		if ($(this).val() == "")
		{
			var input = $(this).parent().parent().find(".soy_id");

			$(input).val("");
			$(input).attr("placeholder", "* Requerido");
			$(input).addClass("border_rojo");

			valido = false;
		}
	});

	return valido;
}





//Valida que la ultima fila este llena

function ultimaLlena()
{
	valido = true;

	if ($('#cantidad_'+cont_apu).val() == "")
	{
		$('#apu_'+cont_apu).val("");
		$('#apu_'+cont_apu).attr("placeholder", "* Requerido");
		$('#apu_'+cont_apu).addClass("border_rojo");

		$('#cantidad_'+cont_apu).addClass("border_rojo");
		valido = false;
	}

	return valido;
}
//Agrega partidas

$(document).on("click", "#agregar", function()
{
	if (cont_partida != 0)
	{
		var todo_lleno = true;
		
		if (todo_lleno) todo_lleno = ultimaLlena();

		if (todo_lleno)
			agregarPartida();
	}
	else
		agregarPartida();
})

function agregarPartida()
{
	cont_partida++;
	var igual_partida = cont_partida;

	$.ajax({
        type:'POST',
        cache: false,
        url: '/presupuestos/agregar_partida',
        success: function(response)
        {
            $("#table_body").append(response);

            $('#partida_'+igual_partida).donetyping(function(){
				traerInfoPartida(igual_partida);
			});

			$(document).on("keyup paste change", "#numero_"+igual_partida, function(){
				yaEsValido($(this));
			})

            $(document).on("click", "#remover_"+igual_partida, function(){
				removerFila(igual_partida);
			});
        },
        data: {
        	cont_partida: igual_partida
        }
    });
}





//Trae la inofo de la partida

function traerInfoPartida(cont_partida)
{
	$.ajax({
        type:'POST',
        cache: false,
        url: '/partidas/traer_info',
        success: function(response)
        {
			actualizarTotal(-1*regresarFloat($("#importe_"+cont_partida).val()));

            $("#tr_"+cont_partida).replaceWith(response);

            $('#partida_'+cont_partida).donetyping(function(){
				traerInfoPartida(cont_partida);
			});

			var poner_focus = $('#partida_'+cont_partida);
			var length_texto = poner_focus.val().length;
			poner_focus.focus();
			poner_focus[0].setSelectionRange(length_texto, length_texto);	

			actualizarTotal(regresarFloat($("#importe_"+cont_partida).val()));	
        },
        data: {
        	identificador: $('#partida_'+cont_partida).val(),
        	cont_partida: cont_partida
        }
    });
}





//Actualiza total

function actualizarTotal(importe)
{
	var total_actual = $("#total").text().substring(2);
	total_actual = regresarFloat(total_actual);

	var total_nuevo = total_actual + importe;
	total_nuevo = (total_nuevo).toFixed(2);
	$("#total").text("$ "+$.number(total_nuevo, 2));

	var iva = total_nuevo * 0.16;
	iva = (iva).toFixed(2);
	$("#iva").text("$ "+$.number(iva, 2));

	var gran_total = regresarFloat(total_nuevo) + regresarFloat(iva);
	gran_total = (gran_total).toFixed(2);;
	$("#gran_total").text("$ "+$.number(gran_total, 2));
}





//Valida que la ultima fila este llena

function ultimaLlena()
{
	valido = true;

	if ($('#nombre_'+cont_partida).val() == "")
	{
		$('#partida_'+cont_partida).val("");
		$('#partida_'+cont_partida).attr("placeholder", "* Requerido");
		$('#partida_'+cont_partida).addClass("border_rojo");

		$('#partida_'+cont_partida).addClass("border_rojo");
		valido = false;
	}

	return valido;
}





//Valida que todos los numero esten llenos

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





//Remueve el placeholder y el borde rojo

function yaEsValido(input)
{
	$(input).removeAttr("placeholder");
	$(input).removeClass("border_rojo");
}





//Cuando quita una fila

function removerFila(cont_partida)
{
	actualizarTotal(-1*regresarFloat($("#importe_"+cont_partida).val()));

	$("#tr_"+cont_partida).remove();
}
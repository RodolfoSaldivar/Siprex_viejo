//Componentes de materialize

$(document).ready(function() {
	$('#pu_modal').modal({
		dismissible: false,
  		endingTop: '5%',
		ready: function() { cuandoModalAbre(); },
		complete: function() { cerrarModalInsumos(); }
	});
	$('#insumos_modal').modal({
		dismissible: false,
  		endingTop: '5%'
	});
	$('#modal_agregar_insumo').modal({
		dismissible: false,
  		endingTop: '5%'
	});
});

var cont_insumo = 1;
var cont_modal = 2;




//Cada vez que se abra el modal

function cuandoModalAbre()
{
	cont_pu++;
	$("#nombre-error").text("*Requerido");
	$("#materialize-modal-overlay-"+cont_modal).addClass('hide');
	cont_modal+= 2;
}




//Ajax cuando escribe el Insumo ID

$('#insumo_1').donetyping(function(){
	traer_info(1);
});

// function traer_info(cont_insumo)
// {
// 	$.ajax({
//         type:'POST',
//         cache: false,
//         url: '/insumos/traer_info',
//         success: function(response)
//         {
//             $("#tr_"+cont_insumo).replaceWith(response);

//             $('#insumo_'+cont_insumo).donetyping(function(){
// 				traer_info(cont_insumo);
// 			});
// 			$(document).on("keyup paste change", "#modal_cantidad_"+cont_insumo, function(){
// 				cantidadModal(cont_insumo);
// 			});
// 			var poner_focus = $('#insumo_'+cont_insumo);
// 			var length_texto = poner_focus.val().length;
// 			poner_focus.focus();
// 			poner_focus[0].setSelectionRange(length_texto, length_texto);
//         },
//         data: {
//         	id: $('#insumo_'+cont_insumo).val(),
//         	cont_insumo: cont_insumo
//         }
//     });
// }




//Cada que cambie la cantidad del insumo en el modal

function cantidadModal(cont_insumo)
{
	if ($("#modal_cantidad_"+cont_insumo).val() >= 0)
	{
		var multiplicacion = regresarFloat($("#modal_precio_venta_"+cont_insumo).val()) * regresarFloat($("#modal_cantidad_"+cont_insumo).val());

		$("#modal_precio_"+cont_insumo).val($.number(multiplicacion, 2));
	}
	else
	{
		$(this).val("0");
		$("#modal_precio_"+cont_insumo).val("0.00");
	}
}




//Ajax para agregar insumos al modal

$(document).on("click", "#agregar_insumo", function()
{
	var todo_lleno = true;

	if ($('#modal_descripcion_'+cont_insumo).val() == "")
	{
		$('#insumo_'+cont_insumo).attr("placeholder", "* Requerido");
		$('#insumo_'+cont_insumo).addClass("border_rojo");
		todo_lleno = false;
	}
	
	if ($('#modal_cantidad_'+cont_insumo).val() == "")
	{
		$('#modal_cantidad_'+cont_insumo).addClass("border_rojo");
		todo_lleno = false;
	}

	if (todo_lleno)
		agregarInsumo();
});

function agregarInsumo()
{
	cont_insumo++;
	
	$.ajax({
        type:'POST',
        cache: false,
        url: '/analisis_precios_us/agregar_insumo',
        success: function(response)
        {
            $("#table_body").append(response);
            $('#insumo_'+cont_insumo).donetyping(function(){
				traer_info(cont_insumo);
			});
			$(document).on("click", "#remover_"+cont_insumo, function(){
				$(this).parent().parent().remove();
			});
        },
        data: {
        	cont_insumo: cont_insumo
        }
    });
}




//Cuando en el modal le pica cancelar

$(document).on("click", "#modal_cancelar", function(){
	vaciarModal();
});

function vaciarModal()
{
	$("#nombre").val("");
	$("#nombre-error").css("display", "none");
	// $("#insumo_1").val("");
	// traer_info(1);
	$("#table_body").children().each(function() {
		$(this).remove();
	});
	$("#table_body").append('<tr class="quitar_tr"><td></td></tr><tr class="quitar_tr"><td></td></tr>');

	$("#tbody_insumos").children().each(function() {
		$(this).remove();
	});
	$("#tbody_insumos").append('<tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>');
	cont_insumo = 1;
}




//Cuando en el modal le pica aceptar

$(document).on("click", "#modal_aceptar", function(e)
{
	var completo = true;
	if ($("#nombre").val() == "")	
	{	
		completo = false;
		$("#nombre-error").css("display", "initial");
	}

	if ($('#modal_descripcion_'+cont_insumo).val() == "")
	{
		completo = false;
		$('#insumo_'+cont_insumo).attr("placeholder", "* Requerido");
		$('#insumo_'+cont_insumo).addClass("border_rojo");
	}

	// if ($('#modal_cantidad_'+cont_insumo).val() == "")
	// {
	// 	completo = false;
	// 	$('#modal_cantidad_'+cont_insumo).addClass("border_rojo");
	// }

	$("#table_body .cantidad_validar").each(function()
	{
		if ($(this).val() == "" || $(this).val() <= 0)
		{
			$(this).addClass("border_rojo");

			completo = false;
		}
	});

	if($('#tipo_insumo option:selected').val() == "nada")
	{
		completo = false;
		$("#tipo_insumo-error").css("display", "initial");
	}

	if($('#referencia option:selected').val() == "nada")
	{
		completo = false;
		$("#referencia-error").css("display", "initial");
	}

	if (completo)
	{
		$('#pu_modal').modal('close');
		cont_insumo = 1;
		llenarTabla();
		vaciarModal();
	}
});




//Cada vez que se cierre el modal

function llenarTabla()
{
	var nombre = $("#nombre").val();
	$('<tr><td><div class="border_top"></div><span class="white-text">-</span></td><td><div class="border_top"></div><span class="white-text">-</span><b>'+nombre+'</b></td><td><div class="border_top"></div><span class="white-text">-</span></td><td><div class="border_top"></div><span class="white-text">-</span></td><td><div class="border_top"></div><span class="white-text">-</span></td><td><div class="border_top"></div><span class="white-text">-</span></td></tr>').insertBefore('#poner_antes');

	var acum_precios = 0;

	$("#table_body").children().each(function() {
		var key = $(this).attr("name");
		llenarFila(key);

		var precio_insumo = regresarFloat($("#modal_cantidad_"+key).val()) * regresarFloat($("#modal_precio_venta_"+key).val());

		acum_precios = acum_precios + precio_insumo;
	});

	$('<tr id="precio_'+cont_pu+'"><td></td><td></td><td></td><td></td><td></td><td class="decimal"><b>'+$.number(acum_precios, 2)+'</b></td></tr>').insertBefore('#poner_antes');

	$('<input type="hidden" name="data[PU]['+cont_pu+'][nombre]" value="'+nombre+'">').insertBefore('#poner_antes');

	actualizarCostoDirecto(acum_precios);
}

function llenarFila(key)
{
	$.ajax({
        type:'POST',
        cache: false,
        url: '/analisis_precios_us/llenar_fila',
        success: function(response)
        {
            $(response).insertBefore("#precio_"+cont_pu);
        },
        data: {
        	key: key,
        	cont_pu: cont_pu,
        	identificador: $("#insumo_"+key).val(),
        	descripcion: $("#modal_descripcion_"+key).val(),
        	unidad: $("#modal_unidad_"+key).val(),
        	precio_venta: regresarFloat($("#modal_precio_venta_"+key).val()),
        	cantidad: regresarFloat($("#modal_cantidad_"+key).val()),
        	precio: regresarFloat($("#modal_precio_"+key).val())
        }
    });
}

function actualizarCostoDirecto(precio_pu)
{
	var subtotal_actual = $("#apu_subtotal").val().substring(2);
	subtotal_actual = regresarFloat(subtotal_actual);

	var subtotal_nuevo = subtotal_actual + precio_pu;
	subtotal_nuevo = (subtotal_nuevo).toFixed(2);

	$("#apu_subtotal").val("$ "+$.number(subtotal_nuevo, 2));

	actualizarCostoIndirecto();
}




//Cada vez que cambie el % de costo indirecto

$(document).on("keyup paste change", "#indirecto_p", function() {
	if ($(this).val() >= 0)
		actualizarCostoIndirecto();
	else
		$(this).val("0");
});

function actualizarCostoIndirecto()
{
	var subtotal_actual = $("#apu_subtotal").val().substring(2);
	subtotal_actual = regresarFloat(subtotal_actual);

	var porciento = $("#indirecto_p").val() / 100;

	var costo_indirecto = subtotal_actual * porciento;
	costo_indirecto = $.number(costo_indirecto, 2);

	$("#costo_indirecto").val("$ "+costo_indirecto);

	var subtotal_1 = regresarFloat(subtotal_actual) + regresarFloat(costo_indirecto);
	subtotal_1 = $.number(subtotal_1, 2);
	$("#subtotal_1").text("$ "+subtotal_1);

	actualizarCostoFinanciero();
}




//Cada vez que cambie el % de costo financiero

$(document).on("keyup paste change", "#financiero_p", function() {
	if ($(this).val() >= 0)
		actualizarCostoFinanciero();
	else
		$(this).val("0");
});

function actualizarCostoFinanciero()
{
	var subtotal_1 = $("#subtotal_1").text().substring(2);
	subtotal_1 = regresarFloat(subtotal_1);

	var porciento = $("#financiero_p").val() / 100;

	var costo_financiero = subtotal_1 * porciento;
	costo_financiero = $.number(costo_financiero, 2);

	$("#costo_financiero").val("$ "+costo_financiero);

	var subtotal_2 = regresarFloat(subtotal_1) + regresarFloat(costo_financiero);
	subtotal_2 = $.number(subtotal_2, 2);
	$("#subtotal_2").text("$ "+subtotal_2);

	actualizarCostoUtilidad();
}




//Cada vez que cambie el % de costo financiero

$(document).on("keyup paste change", "#utilidad_p", function() {
	if ($(this).val() >= 0)
		actualizarCostoUtilidad();
	else
		$(this).val("0");
});

function actualizarCostoUtilidad()
{
	var subtotal_2 = $("#subtotal_2").text().substring(2);
	subtotal_2 = regresarFloat(subtotal_2);

	var porciento = $("#utilidad_p").val() / 100;

	var costo_utilidad = subtotal_2 * porciento;
	costo_utilidad = $.number(costo_utilidad, 2);

	$("#costo_utilidad").val("$ "+costo_utilidad);

	var apu_total = regresarFloat(subtotal_2) + regresarFloat(costo_utilidad);
	apu_total = (apu_total).toFixed(2);
	$("#apu_total").text("$ "+$.number(apu_total, 2));
}
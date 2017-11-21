<?php

	$documento = array();

// -----------------------------------------------------------------------------
	
	$fila = array(
		'IdENTIFICADOR', "", "", 'CANTIDAD'
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array(
		$apu["AnalisisPreciosU"]["clave"], "", "", $apu["ApuPartida"]["cantidad"]
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array();
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array(
		'UNIDAD', "", "", 'CONCEPTO'
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array(
		$apu["AnalisisPreciosU"]["unidad"], "", "", $apu["AnalisisPreciosU"]["descripcion"]
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array();
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array(
		'PARTIDA'
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array(
		$partida_nombre
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array();
	array_push($documento, $fila);
	array_push($documento, $fila);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array(
		'ID', 'DESCRIPCION', 'UNIDAD', 'PRECIO U.', 'CANTIDAD', 'TOTAL'
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	foreach ($apu["PU"] as $keyP => $pu)
	{
		$fila = array(
			"", $pu["PreciosUnitario"]["nombre"]
		);
		array_push($documento, $fila);

		foreach ($pu["Insumos"] as $keyI => $insumo)
		{
			$fila = array(
				$insumo["Insumo"]["identificador"],
				$insumo["Insumo"]["descripcion"],
				$insumo["Insumo"]["unidad"],
				number_format($insumo["PuInsumo"]["importe"], 2),
				$insumo["PuInsumo"]["cantidad"],
				number_format(
					$insumo["PuInsumo"]["cantidad"] * $insumo["PuInsumo"]["importe"],
					2
				)
			);
			array_push($documento, $fila);
		}

		$fila = array(
			"", "", "", "", "", number_format($pu["PreciosUnitario"]["total"], 2)
		);
		array_push($documento, $fila);
		$fila = array();
		array_push($documento, $fila);
		array_push($documento, $fila);
		array_push($documento, $fila);
	}

// -----------------------------------------------------------------------------
	
	$costo_directo = $apu["AnalisisPreciosU"]["costo_directo"];
	$fila = array(
		"", "", "", 'COSTO DIRECTO', "", number_format($costo_directo, 2)
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array();
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$p_indirecto = $apu["AnalisisPreciosU"]["costo_indirecto"];
	$costo_indirecto = $costo_directo * $p_indirecto / 100;
	$fila = array(
		"", "", "",
		'CARGO INDIRECTO',
		$p_indirecto."%",
		number_format($costo_indirecto, 2)
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$subtotal_1 = $costo_directo + $costo_indirecto;
	$fila = array(
		"", "", "", 'SUBTOTAL(1)', "", number_format($subtotal_1, 2)
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array();
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$p_financiero = $apu["AnalisisPreciosU"]["costo_financiero"];
	$costo_financiero = $subtotal_1 * $p_financiero / 100;
	$fila = array(
		"", "", "",
		'CARGO FINANCIERO',
		$p_financiero."%",
		number_format($costo_financiero, 2)
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$subtotal_2 = $subtotal_1 + $costo_financiero;
	$fila = array(
		"", "", "", 'SUBTOTAL(2)', "", number_format($subtotal_2, 2)
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array();
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$p_utilidad = $apu["AnalisisPreciosU"]["costo_utilidad"];
	$costo_utilidad = $subtotal_2 * $p_utilidad / 100;
	$fila = array(
		"", "", "",
		'CARGO POR UTILIDAD',
		$p_utilidad."%",
		number_format($costo_utilidad, 2)
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$fila = array();
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	
	$gran_total = $subtotal_2 + $costo_utilidad;
	$fila = array(
		"", "", "", "",
		"PRECIO UNITARIO",
		number_format($gran_total, 2)
	);
	array_push($documento, $fila);

// -----------------------------------------------------------------------------
	

	foreach ($documento as $key => $renglon)
		$this->Xls->addRow($renglon);


	$filename = $apu["AnalisisPreciosU"]["clave"];

	echo  $this->Xls->render($filename);


?>
<?php


	$fila = array(
		'IdENTIFICADOR', 'FAMILIA', 'TIPO', 'DESCRIPCION', 'UNIDAD', 'PRECIO VENTA'
	);
	$this->Xls->addRow($fila);

	foreach ($insumos as $datos)
	{
		$fila = array();
		array_push($fila, $datos["Insumo"]["identificador"]);
		array_push($fila, $datos["Insumo"]["referencia"]);
		array_push($fila, $datos["Insumo"]["tipo_insumo"]);
		array_push($fila, $datos["Insumo"]["descripcion"]);
		array_push($fila, $datos["Insumo"]["unidad"]);
		array_push($fila, $datos["Insumo"]["precio_venta"]);

		$this->Xls->addRow($fila);
	}

	$filename='Insumos';

	echo  $this->Xls->render($filename);


?>
<?php
App::uses('AppController', 'Controller');
/**
 * Insumos Controller
 *
 * @property Insumo $Insumo
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class InsumosController extends AppController {

	public $helpers = array('Xls');
	

//=========================================================================


	public function isAuthorized($user)
	{
		//Acceso para todos
		return true;
    }
	

//=========================================================================


	function download()
	{
		$insumos = $this->Insumo->todosInsumos($this->miEmpresa());

	    $this->set('insumos', $insumos);
	    $this->layout = 0;
	    $this->autoLayout = false;
	    Configure::write('debug', '0');
	}
	

//=========================================================================


	public function index()
	{
		$empresa_id = $this->miEmpresa();
		$insumos = $this->Insumo->todosInsumos($empresa_id);
		$tipo_user = $this->Session->read("Auth.User.tipo_user");
		$this->set('insumos', $insumos);
		$this->set('tipo_user', $tipo_user);
	}
	

//=========================================================================


	public function reuse()
	{
		$empresa_id = $this->miEmpresa();

		$insumos = $this->Insumo->find('all', array(
			'conditions' => array(
				'empresa_id' => 0
			),
			'fields' => array(
				'id', 'identificador', 'descripcion', 'tipo_insumo', 'precio_compra', 'precio_venta', 'unidad', 'referencia'
			),
			'order' => array('empresa_id', 'referencia', 'tipo_insumo', 'identificador')
		));

		foreach ($insumos as $key => $insumo)
		{
			$id_encriptada = $this->Insumo->encriptacion($insumo["Insumo"]["id"]);
			$insumos[$key]["Insumo"]["id"] = $id_encriptada;
		}

		$tipo_user = $this->Session->read("Auth.User.tipo_user");
		$this->set('insumos', $insumos);
		$this->set('tipo_user', $tipo_user);
	}
	

//=========================================================================


	public function filtro()
	{
		$this->layout='ajax';

		$data = $this->request->data;

		$empresa_id = $this->miEmpresa();
		
		$todo_vacio = false;
		if (empty($data['identificador']) &&
			empty($data['tipo_insumo']) &&
			empty($data['descripcion']))
		{
			$todo_vacio = true;
		}
		else
		{
			$valido = $this->Insumo->validarBuscador($data);

			if (!$valido)
				$this->set("insumos", "");
			else
			{
				//Condiciones default
				$condiciones = array(
					'empresa_id' => $empresa_id
				);

				//Agrega la condicion si su campo no esta vacio
				if (!empty($data['identificador']))
					$condiciones["CHARINDEX('".$data['identificador']."', identificador) >"] = "0";

				if (!empty($data['tipo_insumo']))
					$condiciones["CHARINDEX('".$data['tipo_insumo']."', tipo_insumo) >"] = "0";

				if (!empty($data['descripcion']))
					$condiciones["CHARINDEX('".$data['descripcion']."', descripcion) >"] = '0';

				//Busca
				$encontrados = $this->Insumo->find('all', array(
					'conditions' => $condiciones,
					'fields' => array(
						'id', 'identificador', 'descripcion', 'tipo_insumo', 'precio_compra', 'precio_venta', 'unidad'
					),
					'order' => array('tipo_insumo', 'identificador')
				));


				//Mete la encriptacion
			    foreach ($encontrados as $key => $insumo)
			    {
			    	$id_encriptada = $this->Insumo->encriptacion($insumo['Insumo']['id']);
			    	$encontrados[$key]['Insumo']['id'] = $id_encriptada;
			    }
			}
		}

	    //Checa que no este todo vacio
		if ($todo_vacio)
			$this->set("insumos", $this->Insumo->todosInsumos($empresa_id));
		else
			@$this->set("insumos", $encontrados);
	}
	

//=========================================================================


	public function view($id = null)
	{
		$id = $this->Insumo->desencriptacion($id);

		if (!$this->Insumo->exists($id))
		{
			$this->Session->setFlash('Insumo Inválido.');
			$this->redirect($this->referer());
		}

		$insumo = $this->Insumo->insumoEspecifico($id);

		$this->set('insumo', $insumo);
	}
	

//=========================================================================


	public function add($por_modal = 0)
	{
		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$data['Insumo']['empresa_id'] = $this->miEmpresa();

			$guardado = $this->Insumo->guardarEnBDD($data['Insumo'], "agregar");

			if ($guardado != 1)
				$this->Session->setFlash($guardado);
			else
			{
				$this->Flash->setFlash('Insumo guardado exitosamente.');
				if ($por_modal)
					$this->redirect("/analisis_precios_us/edit/$por_modal");
				else
					$this->redirect(array('action' => 'index'));
			}
		}

		$contactos = $this->Insumo->Contacto->find('list', array(
			'fields' => array('Contacto.id', 'Contacto.nombreYpuesto'),
			'conditions' => array('empresa_id' => $this->miEmpresa())
		));

		$this->set('contactos', $contactos);
	}
	

//=========================================================================


	public function edit($id = null, $reusar = 0)
	{
		$id = $this->Insumo->desencriptacion($id);

		if (!$this->Insumo->exists($id))
		{
			$this->Session->setFlash('Insumo Inválido.');
			$this->redirect($this->referer());
		}

		if ($this->request->is(array('post', 'put')))
		{
			$data = $this->request->data;

			$data['Insumo']['empresa_id'] = $this->miEmpresa();

			if (!$reusar)
				$guardado = $this->Insumo->guardarEnBDD($data['Insumo'], "editar");
			else
				$guardado = $this->Insumo->guardarEnBDD($data['Insumo'], "agregar");

			if ($guardado != 1)
				$this->Session->setFlash($guardado);
			else
			{
				$this->Flash->setFlash('Insumo guardado exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}


		$insumo = $this->Insumo->insumoEspecifico($id);

		$contactos = $this->Insumo->Contacto->find('list', array(
			'fields' => array('Contacto.id', 'Contacto.nombreYpuesto'),
			'conditions' => array('empresa_id' => $this->miEmpresa())
		));

		$this->set('insumo', $insumo['Insumo']);
		$this->set('contactos', $contactos);
	}
	

//=========================================================================


	public function modal_insumos()
	{
		$this->layout='ajax';

		$tipo_insumo = $this->request->data["tipo_insumo"];
		$referencia = $this->request->data["referencia"];
		
		$condiciones = array(
			'empresa_id' => $this->miEmpresa(),
			'tipo_insumo' => $tipo_insumo,
			'referencia' => $referencia
		);

		$insumos = $this->Insumo->traerInsumos($condiciones);

		$this->set('insumos', $insumos);
	}
	

//=========================================================================


	public function revisar_identificador()
	{
		$this->layout='ajax';

		$nuevo_id = $this->request->data["nuevo_id"];
		
		$repetido = $this->Insumo->find('count', array(
			'conditions' => array(
				'identificador' => $nuevo_id,
				'empresa_id' => $this->miEmpresa()
			)
		));

		if (!empty($this->request->data["actual_id"]))
		{
			$actual_id = $this->request->data["actual_id"];

			if ($nuevo_id == $actual_id)
				$repetido--;
		}

		if ($repetido > 0)
		{
			$this->set('identificador', '');
			$this->set('placeholder', 'Ese ID ya esta en uso.');
		}
		else
		{
			$this->set('identificador', $nuevo_id);
			$this->set('placeholder', '');
		}
	}
	

//=========================================================================


	public function traer_info()
	{
		$this->layout='ajax';

		$valido = $this->Insumo->validarBuscador($this->request->data);

		$identificador = $this->request->data["id"];
		$cont_insumo = $this->request->data["cont_insumo"];

		if (!$valido)
			$this->set("insumo", "");
		else
		{
			$insumo = $this->Insumo->find('first', array(
				'conditions' => array(
					'identificador' => strval($identificador),
					'empresa_id' => $this->miEmpresa()
				),
				'fields' => array(
					'id', 'identificador', 'descripcion', 'unidad', 'cantidad', 'precio_venta'
				)
			));

			$this->set('insumo', @$insumo["Insumo"]);
		}

		$this->set('identificador', $identificador);
		$this->set('cont_insumo', $cont_insumo);
	}
	

//=========================================================================


	public function traer_info_fuera()
	{
		$this->layout='ajax';

		$valido = $this->Insumo->validarBuscador($this->request->data);

		$identificador = $this->request->data["id"];
		$keyP = $this->request->data["keyP"];
		$keyI = $this->request->data["keyI"];

		if (!$valido)
			$this->set("insumo", "");
		else
		{
			$insumo = $this->Insumo->find('first', array(
				'conditions' => array(
					'identificador' => strval($identificador),
					'empresa_id' => $this->miEmpresa()
				),
				'fields' => array(
					'id', 'identificador', 'descripcion', 'unidad', 'cantidad', 'precio_venta'
				)
			));

			$this->set('insumo', @$insumo["Insumo"]);
		}

		$this->set('identificador', $identificador);
		$this->set('keyP', $keyP);
		$this->set('keyI', $keyI);
	}
	

//=========================================================================


	public function resultados($fila = null, $agregados = null, $actualizados = null, $errores_filas = null)
    {
	    $this->set("fila", $fila);
	    $this->set("agregados", $agregados);
	    $this->set("actualizados", $actualizados);
	    $this->set("errores_filas", json_decode(base64_decode($errores_filas), true));
    }
	

//=========================================================================


	public function descargar_excel($nombre = null)
    {
    	if (!in_array($nombre, array("plantillaInsumos")))
    		$this->redirect("/insumos/subir_excel");

        $filename = $nombre.".xls";
        $name = explode('.',$filename);
        $this->viewClass = 'Media';

        $params = array(
            'id'        => $filename,
            'name'      => $name[0],
            'download'  => 1,
            'extension' => $name[1],
            'path'      => APP . 'Plantillas' . DS
        );

        $this->set($params);
    }
	

//=========================================================================


	public function subir_excel()
	{
		if (!empty($this->request->data))
		{
			$data = $this->request->data['archivo'];

        	$name = explode('.',$data['name']);

        	if ($name[1] != "xls") 
        	{
        		$this->Session->setFlash('Solo archivos "xls".');
        		$this->redirect("/insumos/subir_excel");
        	}

        	if (substr($name[0], 0, 16) != "plantillaInsumos") 
        	{
        		$this->Session->setFlash('Elija el mismo archivo descargado.');
        		$this->redirect("/insumos/subir_excel");
        	}

			require_once 'php/reader.php';
			$arch_excel = new Spreadsheet_Excel_Reader();
			$arch_excel->setOutputEncoding('iso-8859-1');
			$arch_excel->read($data['tmp_name']);
			error_reporting(E_ALL ^ E_NOTICE);

			$insumosAgregados = 0;
			$insumosActualizados = 0;
			$errores_filas = array();

			//Por la cantidad de filas que tenga el archivo
			//La fila 1 son los títulos, por lo que la info empieza en la 2
			for ($fila = 2; $fila <= $arch_excel->sheets[0]['numRows']; $fila++)
			{
				@$celdas = array_map("trim", $arch_excel->sheets[0]['cells'][$fila]);

				//Siempre debe estar el identificador
				if (!empty($celdas[1]))
				{
					$insumo = $this->Insumo->find('first', array(
						'conditions' => array(
							'identificador' => $celdas[1],
							'empresa_id' => $this->miEmpresa()
						),
						'fields' => array(
							'id', 'identificador', 'tipo_insumo', 'empresa_id', 'descripcion', 'referencia', 'marca', 'modelo', 'cantidad', 'unidad', 'precio_compra', 'precio_venta'
						)
					));

					//Significa que no existe y se dara de alta
					if (empty($insumo['Insumo']['id']))
					{
						//Si el "tipo" esta bien escrito y tiene los campos obligatorios llenos
						if (!empty($celdas[3]) &&
							!empty($celdas[4]) &&
							!empty($celdas[7]) &&
							!empty($celdas[8]) &&
							in_array($celdas[2], array(
								"Materiales", "Herramientas", "Equipos", "Mano de Obra", "Auxiliares"
							)))
						{
							$agregarFila = $this->agregarFila($celdas, "nuevo");
							if ($agregarFila == 1)
								$insumosAgregados++;
							else
								$errores_filas[$fila] = $agregarFila;
						}
						else
							$errores_filas[$fila] = "Necesita los campos obligatorios.";
					}
					else
					{	//Significa que ya existe y se actualizara
						$agregarFila = $this->agregarFila($celdas, $insumo['Insumo']);
						if ($agregarFila == 1)
							$insumosActualizados++;
						else
							$errores_filas[$fila] = $agregarFila;
					}
				}
				else
					$errores_filas[$fila] = "No hay identificador.";
			}
			
			$errores_filas = base64_encode(json_encode($errores_filas));

			$fila = $fila - 2;
			$this->redirect("/insumos/resultados/$fila/$insumosAgregados/$insumosActualizados/$errores_filas");
		}
	}


	function agregarFila($celdas, $insumo)
    {
		$accion = "agregar";

		if ($insumo != "nuevo")
		{
			$datos_insumo = $insumo;
			$accion = "editar";
		}

		$datos_insumo['empresa_id'] = $this->miEmpresa();

		if (!empty($celdas[1]))
			$datos_insumo['identificador'] = $celdas[1];

		if (!empty($celdas[2]))
			$datos_insumo['tipo_insumo'] = $celdas[2];

		if (!empty($celdas[3]))
			$datos_insumo['descripcion'] = $celdas[3];

		if (!empty($celdas[4]))
			$datos_insumo['referencia'] = $celdas[4];

		if (!empty($celdas[5]))
			$datos_insumo['marca'] = $celdas[5];

		if (!empty($celdas[6]))
			$datos_insumo['modelo'] = $tipo = $celdas[6];

		if (!empty($celdas[7]))
			$datos_insumo['cantidad'] = $celdas[7];

		if (!empty($celdas[8]))
			$datos_insumo['unidad'] = $celdas[8];

		if (!empty($celdas[9]))
			$datos_insumo['precio_compra'] = $celdas[9];
		else
			$datos_insumo['precio_compra'] = "0.00";

		if (!empty($celdas[10]))
			$datos_insumo['precio_venta'] = $celdas[10];
		else
			$datos_insumo['precio_venta'] = "0.00";

		$datos_insumo = $this->Insumo->reemplazar($datos_insumo);

		$agregado = $this->Insumo->guardarEnBDD($datos_insumo, $accion);	
		
		return $agregado;
    }
}
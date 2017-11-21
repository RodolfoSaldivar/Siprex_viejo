<?php
App::uses('AppController', 'Controller');
/**
 * AnalisisPreciosUs Controller
 *
 * @property AnalisisPreciosU $AnalisisPreciosU
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class AnalisisPreciosUsController extends AppController {

	public $helpers = array('Xls');
	

//=========================================================================


	public function isAuthorized($user)
	{
		//Acceso para todos
		return true;
    }
	

//=========================================================================


	public function index()
	{
		$empresa_id = $this->miEmpresa();
		$apus = $this->AnalisisPreciosU->todosApu($empresa_id);
		$this->set('apus', $apus);
	}
	

//=========================================================================


	function download($id = 0)
	{
		$this->loadModel("Partida");

		$id = $this->AnalisisPreciosU->desencriptacion($id);

		if (!$this->AnalisisPreciosU->exists($id))
		{
			$this->Session->setFlash('Análisis PU Inválido.');
			$this->redirect($this->referer());
		}

		$apu = $this->AnalisisPreciosU->apuEspecifico($id);
		$partida_id = $apu["ApuPartida"]["partida_id"];
		$partida = $this->Partida->soloPartidas(array(
			'id' => $partida_id
		));

// var_dump($apu);
	    $this->set('apu', $apu);
	    $this->set('partida_nombre', $partida[$partida_id]);

	    $this->layout = 0;
	    $this->autoLayout = false;
	    Configure::write('debug', '0');
	}
	

//=========================================================================


	public function filtro()
	{
		$this->layout='ajax';

		$data = $this->request->data;

		$empresa_id = $this->miEmpresa();
		
		$todo_vacio = false;
		if (empty($data['clave']) &&
			empty($data['descripcion']))
		{
			$todo_vacio = true;
		}
		else
		{
			$valido = $this->AnalisisPreciosU->validarBuscador($data);

			if (!$valido)
				$this->set("apus", "");
			else
			{
				$condiciones = array('empresa_id' => $empresa_id);

				//Agrega la condicion si su campo no esta vacio
				if (!empty($data['clave']))
					$condiciones["CHARINDEX('".$data['clave']."', clave) >"] = "0";

				if (!empty($data['descripcion']))
					$condiciones["CHARINDEX('".$data['descripcion']."', descripcion) >"] = "0";

				//Busca
				$apus = $this->AnalisisPreciosU->busquedaFiltro($condiciones);
			}
		}

	    //Checa que no este todo vacio
		if ($todo_vacio)
			$this->set("apus", $this->AnalisisPreciosU->todosApu($empresa_id));
		else
			@$this->set("apus", $apus);
	}
	

//=========================================================================


	public function activar_desactivar()
	{
		$this->layout='ajax';

		$estatus = $this->request->data["estatus"];
		$id = $this->request->data["id"];
		$id = $this->AnalisisPreciosU->desencriptacion($id);

		$this->AnalisisPreciosU->activarDesactivar($id, $estatus);
	}
	

//=========================================================================


	public function view($id = null)
	{
		$this->loadModel("Partida");
		
		$id = $this->AnalisisPreciosU->desencriptacion($id);

		if (!$this->AnalisisPreciosU->exists($id))
		{
			$this->Session->setFlash('Análisis PU Inválido.');
			$this->redirect($this->referer());
		}

		$apu = $this->AnalisisPreciosU->apuEspecifico($id);
		$partidas = $this->Partida->soloPartidas(array('empresa_id' => $this->miEmpresa()));

		$this->set('partidas', $partidas);
		$this->set('partida_id', $apu["ApuPartida"]["partida_id"]);
		$this->set('apu', $apu);
	}
	

//=========================================================================


	public function add()
	{
		$this->loadModel("ApuPartida");
		$this->loadModel("Partida");

		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$data['APU']['empresa_id'] = $this->miEmpresa();
			$data['APU']['presupuesto_id'] = $this->Session->read("presupuesto_id");
			$data['APU']['costo_indirecto'] = "0";
			$data['APU']['costo_financiero'] = "0";
			$data['APU']['costo_utilidad'] = "0";

			$apu_guardado = $this->AnalisisPreciosU->guardarEnBDD($data, "agregar");

			$redireccionar = 1;
			if ($apu_guardado != 1)
			{
				$this->Session->setFlash($apu_guardado);
				$redireccionar = 0;
			}

			if ($redireccionar)
			{
				$apu_creado = $this->AnalisisPreciosU->find("first", array(
					'conditions' => array(
						'clave' => strval($data['APU']['clave']),
						'empresa_id' => $data['APU']['empresa_id'],
						'presupuesto_id' => $data["APU"]["presupuesto_id"]
					),
					'fields' => array('id')
				));

				$data["ApuPartida"]["apu_id"] = $apu_creado["AnalisisPreciosU"]["id"];

				$apupa_guardado = $this->ApuPartida->guardarEnBDD($data["ApuPartida"], "agregar");

				if ($apupa_guardado != 1)
				{
					$this->Session->setFlash($apu_guardado);
				}
				else
				{
					if ($data["action"] == "analizar")
					{
						$id = $this->AnalisisPreciosU->encriptacion($apu_creado["AnalisisPreciosU"]["id"]);
						$this->redirect("/analisis_precios_us/edit/$id");
					}

					if ($data["action"] == "guardar")
					{
						$this->Flash->setFlash('Concepto guardado.');
						$this->redirect("/partidas");
					}
						
				}
			}
		}

		$partidas = $this->Partida->soloPartidas(array('empresa_id' => $this->miEmpresa()));

		$this->set('partidas', $partidas);
		$this->set('regex', $this->AnalisisPreciosU->regex());
	}
	

//=========================================================================


	public function edit($id = null)
	{
		$this->loadModel("ApuPartida");
		$this->loadModel("Partida");

		$id_encriptada = $id;
		$id = $this->AnalisisPreciosU->desencriptacion($id);

		if (!$this->AnalisisPreciosU->exists($id))
		{
			$this->Session->setFlash('Análisis PU Inválido.');
			$this->redirect($this->referer());
		}
		
		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$data['APU']['empresa_id'] = $this->miEmpresa();
			$data['APU']['presupuesto_id'] = $this->Session->read("presupuesto_id");

			$apu_guardado = $this->AnalisisPreciosU->guardarEnBDD($data, "editar");

			$redireccionar = 1;
			if ($apu_guardado != 1)
			{
				$this->Session->setFlash($apu_guardado);
				$redireccionar = 0;
			}

			if ($redireccionar)
			{
				$data["ApuPartida"]["apu_id"] = $id;

				$apupa_guardado = $this->ApuPartida->guardarEnBDD($data["ApuPartida"], "editar");

				if ($apupa_guardado != 1)
				{
					$this->Session->setFlash($apu_guardado);
				}
				else
				{
					$this->Flash->setFlash('Concepto guardado.');
					$this->redirect("/partidas");	
				}
			}
		}

		$apu = $this->AnalisisPreciosU->apuEspecifico($id);
		$partidas = $this->Partida->soloPartidas(array('empresa_id' => $this->miEmpresa()));

		$this->set('partidas', $partidas);
		$this->set('partida_id', $apu["ApuPartida"]["partida_id"]);
		$this->set('apu', $apu);
		$this->set('id_encriptada', $id_encriptada);
		$this->set('regex', $this->AnalisisPreciosU->regex());
	}
	

//=========================================================================


	public function revisar_clave()
	{
		$this->layout='ajax';

		$nueva_clave = $this->request->data["nueva_clave"];
		$url = $this->request->data["url"];
		
		$repetido = $this->AnalisisPreciosU->find('count', array(
			'conditions' => array(
				'clave' => $nueva_clave,
				'empresa_id' => $this->miEmpresa(),
				'presupuesto_id' => $this->Session->read("presupuesto_id")
			)
		));

		if (!empty($this->request->data["clave_actual"]))
		{
			$clave_actual = $this->request->data["clave_actual"];

			if ($nueva_clave == $clave_actual)
				$repetido--;
		}

		if ($repetido > 0)
		{
			$this->set('clave', '');
			$this->set('placeholder', 'ID en uso.');
		}
		else
		{
			$this->set('clave', $nueva_clave);
			$this->set('placeholder', '');
		}
		
		$this->set('url', $url);
	}
	

//=========================================================================


	public function revisar_partida_apu()
	{
		$this->layout='ajax';

		$nueva_clave = $this->request->data["nueva_clave"];
		$cont_apu = $this->request->data["cont_apu"];
		
		$repetido = $this->AnalisisPreciosU->find('count', array(
			'conditions' => array(
				'clave' => $nueva_clave,
				'empresa_id' => $this->miEmpresa()
			)
		));

		if ($repetido > 0)
		{
			$this->set('clave', '');
			$this->set('placeholder', 'ID en uso.');
		}
		else
		{
			$this->set('clave', $nueva_clave);
			$this->set('placeholder', '');
		}

		$this->set('cont_apu', $cont_apu);
	}
	

//=========================================================================


	public function agregar_insumo()
	{
		$this->layout='ajax';

		$this->set("cont_insumo", $this->request->data["cont_insumo"]);
	}
	

//=========================================================================


	public function agregar_insumo_fuera()
	{
		$this->layout='ajax';

		$this->set("keyP", $this->request->data["keyP"]);
		$this->set("keyI", $this->request->data["keyI"]);
	}
	

//=========================================================================


	public function llenar_fila()
	{
		$this->layout='ajax';

		$this->set("datos", $this->request->data);
	}
	

//=========================================================================


	public function traer_info_apu()
	{
		$this->layout='ajax';

		$valido = $this->AnalisisPreciosU->validarBuscador($this->request->data);

		$clave = $this->request->data["clave"];
		$cont_apu = $this->request->data["cont_apu"];

		if (!$valido)
			$this->set("apu", "");
		else
		{
			$apu = $this->AnalisisPreciosU->find('all', array(
				'conditions' => array(
					'clave' => $clave,
					'empresa_id' => $this->miEmpresa()
				),
				'fields' => array(
					'id', 'clave', 'descripcion', 'unidad', 'costo_indirecto', 'costo_financiero', 'costo_utilidad'
				)
			));

			$apu = $this->AnalisisPreciosU->incluirTotal($apu);

			$this->set('apu', @$apu[0]["AnalisisPreciosU"]);
			
			if (!empty($apu))
				$this->set('cantidad', 1);
		}

		$this->set('clave', $clave);
		$this->set('cont_apu', $cont_apu);
	}
}

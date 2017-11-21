<?php
App::uses('AppController', 'Controller');
/**
 * Partidas Controller
 *
 * @property Partida $Partida
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class PartidasController extends AppController {
	

//=========================================================================


	public function isAuthorized($user)
	{
		//Acceso para todos
		return true;
    }
	

//=========================================================================


	public function index()
	{
		$presupuesto_id = $this->Session->read("presupuesto_id");

		$condiciones = array(
			'empresa_id' => $this->miEmpresa()
		);
		$partidas = $this->Partida->traerPartidas($condiciones, $presupuesto_id);
		$this->set('partidas', $partidas);
	}
	

//=========================================================================


	public function filtro()
	{
		$this->layout='ajax';

		$data = $this->request->data;

		$empresa_id = $this->miEmpresa();
		
		$todo_vacio = false;
		if (empty($data['identificador']) &&
			empty($data['nombre']))
		{
			$todo_vacio = true;
		}
		else
		{
			$valido = $this->Partida->validarBuscador($data);

			if (!$valido)
				$this->set("partidas", "");
			else
			{
				$condiciones = array('empresa_id' => $empresa_id);

				//Agrega la condicion si su campo no esta vacio
				if (!empty($data['identificador']))
					$condiciones["CHARINDEX('".$data['identificador']."', identificador) >"] = "0";

				if (!empty($data['nombre']))
					$condiciones["CHARINDEX('".$data['nombre']."', nombre) >"] = "0";

				//Busca
				$partidas = $this->Partida->traerPartidas($condiciones);
			}
		}

	    //Checa que no este todo vacio
		if ($todo_vacio)
			$this->set("partidas", $this->Partida->traerPartidas(array('empresa_id' => $empresa_id)));
		else
			@$this->set("partidas", $partidas);
	}
	

//=========================================================================


	public function view($id = null)
	{
		$id = $this->Partida->desencriptacion($id);

		if (!$this->Partida->exists($id))
		{
			$this->Session->setFlash('Partida Inválida.');
			$this->redirect($this->referer());
		}

		$condiciones = array(
			'id' => $id
		);

		$partida = $this->Partida->traerPartidas($condiciones);
		$this->set('partida', $partida);
	}
	

//=========================================================================


	public function modal_agregar()
	{
		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$data['Partida']['empresa_id'] = $this->miEmpresa();

			$partida_guardada = $this->Partida->guardarEnBDD($data, "agregar");

			$redireccionar = 1;
			if ($partida_guardada != 1)
			{
				$this->Session->setFlash($partida_guardada);
				$redireccionar = 0;
			}

			if ($redireccionar)
			{
				$this->Flash->setFlash('Partida guardada.');
				$this->redirect($data["url"]);
			}
		}
	}
	

//=========================================================================


	public function add()
	{
		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$data['Partida']['empresa_id'] = $this->miEmpresa();

			$partida_guardada = $this->Partida->guardarEnBDD($data, "agregar");

			$redireccionar = 1;
			if ($partida_guardada != 1)
			{
				$this->Session->setFlash($partida_guardada);
				$redireccionar = 0;
			}

			if ($redireccionar)
			{
				$this->Flash->setFlash('Partida guardada.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	

//=========================================================================


	public function edit($id = null)
	{
		$id = $this->Partida->desencriptacion($id);

		if (!$this->Partida->exists($id))
		{
			$this->Session->setFlash('Partida Inválida.');
			$this->redirect($this->referer());
		}

		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$data['Partida']['id'] = $this->Partida->desencriptacion($data['Partida']['id']);
			$data['Partida']['empresa_id'] = $this->miEmpresa();

			$partida_guardada = $this->Partida->guardarEnBDD($data, "editar");

			$redireccionar = 1;
			if ($partida_guardada != 1)
			{
				$this->Session->setFlash($partida_guardada);
				$redireccionar = 0;
			}

			if ($redireccionar)
			{
				$this->Flash->setFlash('Partida guardada.');
				$this->redirect(array('action' => 'index'));
			}
		}

		$presupuesto_id = $this->Session->read("presupuesto_id");

		$condiciones = array(
			'id' => $id
		);

		$partida = $this->Partida->traerPartidas($condiciones, $presupuesto_id);
		$this->set('partida', $partida);
	}
	

//=========================================================================


	public function revisar_id()
	{
		$this->layout='ajax';

		$nuevo_id = $this->request->data["nuevo_id"];
		$url = $this->request->data["url"];
		
		$repetido = $this->Partida->find('count', array(
			'conditions' => array(
				'identificador' => $nuevo_id,
				'empresa_id' => $this->miEmpresa()
			)
		));

		if (!empty($this->request->data["id_actual"]))
		{
			$id_actual = $this->request->data["id_actual"];

			if ($nuevo_id == $id_actual)
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

		$this->set('url', $url);
	}
	

//=========================================================================


	public function agregar_existente()
	{
		$this->layout='ajax';

		$this->set("cont_apu", $this->request->data["cont_apu"]);
	}
	

//=========================================================================


	public function agregar_nuevo()
	{
		$this->layout='ajax';

		$this->set("cont_apu", $this->request->data["cont_apu"]);
	}
	

//=========================================================================


	public function traer_info()
	{
		$this->layout='ajax';

		$valido = $this->Partida->validarBuscador($this->request->data);

		$identificador = $this->request->data["identificador"];
		$cont_partida = $this->request->data["cont_partida"];

		if (!$valido)
			$this->set("partida", "");
		else
		{
			$condiciones = array(
				'identificador' => $identificador,
				'empresa_id' => $this->miEmpresa()
			);

			$partida = $this->Partida->traerPartidas($condiciones);

			$this->set('partida', @$partida[0]["Partida"]);
		}

		$this->set('identificador', $identificador);
		$this->set('cont_partida', $cont_partida);
	}
}

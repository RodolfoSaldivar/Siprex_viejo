<?php
App::uses('AppController', 'Controller');
/**
 * Presupuestos Controller
 *
 */
class PresupuestosController extends AppController {
	

//=========================================================================


	public function isAuthorized($user)
	{
		//Acceso para todos
		return true;
    }
	

//=========================================================================


	public function index()
	{
		$condiciones = array('empresa_id' => $this->miEmpresa());

		$presupuestos = $this->Presupuesto->traerPresupuestos($condiciones, $this->miEmpresa());
		$this->set('presupuestos', $presupuestos);
	}
	

//=========================================================================


	public function filtro()
	{
		$this->layout='ajax';

		$data = $this->request->data;

		$empresa_id = $this->miEmpresa();
		
		$todo_vacio = false;
		if (empty($data['obra']) &&
			empty($data['colonia']) &&
			empty($data['ubicacion']))
		{
			$todo_vacio = true;
		}
		else
		{
			$valido = $this->Presupuesto->validarBuscador($data);

			if (!$valido)
				$this->set("presupuestos", "");
			else
			{
				$condiciones = array('empresa_id' => $empresa_id);

				//Agrega la condicion si su campo no esta vacio
				if (!empty($data['obra']))
					$condiciones["CHARINDEX('".$data['obra']."', obra) >"] = "0";

				if (!empty($data['colonia']))
					$condiciones["CHARINDEX('".$data['colonia']."', colonia) >"] = "0";

				if (!empty($data['ubicacion']))
					$condiciones["CHARINDEX('".$data['ubicacion']."', ubicacion) >"] = "0";

				//Busca
				$presupuestos = $this->Presupuesto->traerPresupuestos($condiciones, $empresa_id);
			}
		}

	    //Checa que no este todo vacio
		if ($todo_vacio)
			$this->set("presupuestos", $this->Presupuesto->traerPresupuestos(array('empresa_id' => $empresa_id), $empresa_id));
		else
			@$this->set("presupuestos", $presupuestos);
	}
	

//=========================================================================


	public function view($id = null)
	{
		$id = $this->Presupuesto->desencriptacion($id);

		if (!$this->Presupuesto->exists($id))
		{
			$this->Session->setFlash('Presupuesto Inválido.');
			$this->redirect($this->referer());
		}

		$condiciones = array(
			'id' => $id
		);

		$presupuesto = $this->Presupuesto->traerUnico($condiciones, $this->miEmpresa());

		$this->Session->write("presupuesto_id", $id);
		$this->Session->write("presupuesto_id_encr", $this->Presupuesto->encriptacion($id));
		$this->Session->write("presupuesto_nombre", $presupuesto["Presupuesto"]["obra"]);
		
		$this->set('presupuesto', $presupuesto);
	}
	

//=========================================================================


	public function add()
	{
		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$data['Presupuesto']['empresa_id'] = $this->miEmpresa();

			$presupuesto_guardado = $this->Presupuesto->guardarEnBDD($data, "agregar");

			$redireccionar = 1;
			if ($presupuesto_guardado != 1)
			{
				$this->Session->setFlash($presupuesto_guardado);
				$redireccionar = 0;
			}

			if ($redireccionar)
			{
				$presupuesto_creado = $this->Presupuesto->find("first", array(
					'conditions' => array(
						'obra' => $data['Presupuesto']['obra'],
						'colonia' => $data['Presupuesto']['colonia'],
						'ubicacion' => $data['Presupuesto']['ubicacion'],
						'empresa_id' => $data['Presupuesto']['empresa_id']
					),
					'fields' => array('id')
				));
				$presupuesto_creado = $presupuesto_creado["Presupuesto"]["id"];

				$this->Session->write("presupuesto_id", $presupuesto_creado);
				$this->Session->write("presupuesto_id_encr", $this->Presupuesto->encriptacion($presupuesto_creado));
				$this->Session->write("presupuesto_nombre", $data['Presupuesto']['obra']);

				$this->Flash->setFlash('Presupuesto guardado.');
				$this->redirect("/analisis_precios_us/add");
			}
		}
	}
	

//=========================================================================


	public function edit($id = null)
	{
		$id = $this->Presupuesto->desencriptacion($id);

		if (!$this->Presupuesto->exists($id))
		{
			$this->Session->setFlash('Presupuesto Inválido.');
			$this->redirect($this->referer());
		}

		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$data['Presupuesto']['id'] = $this->Presupuesto->desencriptacion($data['Presupuesto']['id']);
			$data['Presupuesto']['empresa_id'] = $this->miEmpresa();

			$presupuesto_guardado = $this->Presupuesto->guardarEnBDD($data, "editar");

			$redireccionar = 1;
			if ($presupuesto_guardado != 1)
			{
				$this->Session->setFlash($presupuesto_guardado);
				$redireccionar = 0;
			}

			if ($redireccionar)
			{
				$this->Session->write("presupuesto_nombre", $data['Presupuesto']['obra']);
				$this->Flash->setFlash('Presupuesto guardado.');
				$this->redirect("/partidas");
			}
		}

		$condiciones = array(
			'id' => $id
		);

		$presupuesto = $this->Presupuesto->traerPresupuestos($condiciones, $this->miEmpresa());

		$this->Session->write("presupuesto_id", $id);
		$this->Session->write("presupuesto_id_encr", $this->Presupuesto->encriptacion($id));
		$this->Session->write("presupuesto_nombre", $presupuesto[0]["Presupuesto"]["obra"]);

		$this->set('presupuesto', $presupuesto);
	}
	

//=========================================================================


	public function revisar_id()
	{
		$this->layout='ajax';

		$nuevo_id = $this->request->data["nuevo_id"];
		
		$repetido = $this->Presupuesto->find('count', array(
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
	}
	

//=========================================================================


	public function agregar_partida()
	{
		$this->layout='ajax';

		$this->set("cont_partida", $this->request->data["cont_partida"]);
	}
}

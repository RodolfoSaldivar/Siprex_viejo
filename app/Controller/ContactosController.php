<?php
App::uses('AppController', 'Controller');
/**
 * Contactos Controller
 *
 * @property Contacto $Contacto
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ContactosController extends AppController {
	

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
		$contactos = $this->Contacto->todosContactos($empresa_id);
		$this->set('contactos', $contactos);
	}
	

//=========================================================================


	public function filtro()
	{
		$this->layout='ajax';

		$data = $this->request->data;

		$empresa_id = $this->miEmpresa();
		
		$todo_vacio = false;
		if (empty($data['tipo_contacto']) &&
			empty($data['nombre']) &&
			empty($data['puesto']) &&
			empty($data['rfc']) &&
			empty($data['correo']))
		{
			$todo_vacio = true;
		}
		else
		{
			$valido = $this->Contacto->validarBuscador($data);

			if (!$valido)
				$this->set("contactos", "");
			else
			{
				//Condiciones default
				$condiciones = array(
					'empresa_id' => $empresa_id
				);

				//Agrega la condicion si su campo no esta vacio
				if (!empty($data['tipo_contacto']))
					$condiciones["CHARINDEX('".$data['tipo_contacto']."', tipo_contacto) >"] = "0";

				if (!empty($data['nombre']))
					$condiciones["CHARINDEX('".$data['nombre']."', nombre) >"] = '0';

				if (!empty($data['puesto']))
					$condiciones["CHARINDEX('".$data['puesto']."', puesto) >"] = '0';

				if (!empty($data['rfc']))
					$condiciones["CHARINDEX('".$data['rfc']."', rfc) >"] = '0';

				if (!empty($data['correo']))
					$condiciones["CHARINDEX('".$data['correo']."', correo) >"] = '0';

				//Busca
				$encontrados = $this->Contacto->find('all', array(
					'conditions' => $condiciones,
					'fields' => array(
						'id', 'tipo_contacto', 'nombre', 'puesto', 'rfc', 'correo'
					),
					'order' => array('tipo_contacto', 'nombre')
				));


				//Mete la encriptacion
			    foreach ($encontrados as $key => $contacto)
			    {
			    	$encontrados[$key]["Contacto"]["id_original"] = $contacto["Contacto"]["id"];
			    	$id_encriptada = $this->Contacto->encriptacion($contacto['Contacto']['id']);
			    	$encontrados[$key]['Contacto']['id'] = $id_encriptada;
			    }
			}
		}

	    //Checa que no este todo vacio
		if ($todo_vacio)
			$this->set("contactos", $this->Contacto->todosContactos($empresa_id));
		else
			@$this->set("contactos", $encontrados);
	}
	

//=========================================================================


	public function view($id = null)
	{
		$id = $this->Contacto->desencriptacion($id);

		if (!$this->Contacto->exists($id))
		{
			$this->Session->setFlash('Contacto Inválido.');
			$this->redirect($this->referer());
		}

		$contacto = $this->Contacto->contactoEspecifico($id);

		$this->set('contacto', $contacto["Contacto"]);
	}
	

//=========================================================================


	public function add()
	{
		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$data['Contacto']['empresa_id'] = $this->miEmpresa();

			$guardado = $this->Contacto->guardarEnBDD($data['Contacto'], "agregar");

			if ($guardado != 1)
				$this->Session->setFlash($guardado);
			else
			{
				$this->Flash->setFlash('Contacto guardado exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	

//=========================================================================


	public function edit($id = null)
	{
		$id = $this->Contacto->desencriptacion($id);
		
		if (!$this->Contacto->exists($id))
		{
			$this->Session->setFlash('Contacto Inválido.');
			$this->redirect($this->referer());
		}

		if ($this->request->is(array('post', 'put')))
		{
			$data = $this->request->data;

			$guardado = $this->Contacto->guardarEnBDD($data['Contacto'], "editar");

			if ($guardado != 1)
				$this->Session->setFlash($guardado);
			else
			{
				$this->Flash->setFlash('Contacto guardado exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}


		$contacto = $this->Contacto->contactoEspecifico($id);

		$this->set('contacto', $contacto['Contacto']);
	}
}

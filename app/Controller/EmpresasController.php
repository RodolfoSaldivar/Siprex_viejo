<?php
App::uses('AppController', 'Controller');
/**
 * Empresas Controller
 *
 * @property Empresa $Empresa
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class EmpresasController extends AppController {
	

//=========================================================================


	public function isAuthorized($user)
	{
		//Acceso para SuperAdmins
		if (in_array($this->action, array('seleccionar', 'activo_actualizar', 'index', 'view', 'add', 'edit', 'delete')))
		{
            if (isset($user['tipo_user']) && in_array($user['tipo_user'], array("SA")))
    		{
    			return true;
    		}
        }

	    return parent::isAuthorized($user);
    }
	

//=========================================================================
	

	public function seleccionar($id = null)
	{
		if ($this->Session->read('Auth.User.tipo_user') != "SA")
			$this->redirect($this->Auth->redirectURL());
	    
	    $this->layout = 'login';

	    if (!empty($id))
	    {	
	    	$id = $this->Empresa->desencriptacion($id);
	    	$this->Session->write("mi_empresa", $id);
			$this->redirect($this->Auth->redirectUrl());
	    }

	    //Cuando escoge el colegio
	    if (!empty($this->request->data))
		{
			$this->Session->write("mi_empresa", $this->request->data("Empresa.id"));
			$this->redirect($this->Auth->redirectUrl());
		}

		$empresas = $this->Empresa->find('all', array(
	    	'order' => array('nombre'),
	    	'conditions' => array('activo' => 1),
	    	'fields' => array('id', 'nombre')
	    ));

	    $this->set('empresas', $empresas);
	}
	

//=========================================================================
	

	public function activo_actualizar()
	{
		$this->layout='ajax';

		$id = $this->Empresa->desencriptacion($this->request->data['id']);

		if ($this->request->data['activo'] == 1)
			$activo = 0;
		else
			$activo = 1;

		$this->Empresa->query("
			UPDATE ".$this->nombre_bdd.".empresas
			SET activo = $activo
			WHERE id = $id
		");

		$this->request->data["activo"] = $activo;

		$this->set("empresa", $this->request->data);
	}
	

//=========================================================================


	public function index()
	{
		$empresas = $this->Empresa->find('all', array(
			'fields' => array(
				'id', 'nombre', 'activo', 'mail', 'usuarios', 'fecha_corte'
			),
			'order' => array('activo' => 'desc', 'nombre')
		));

		foreach ($empresas as $key => $empresa)
		{
			$id_encriptada = $this->Empresa->encriptacion($empresa["Empresa"]["id"]);
			$empresas[$key]["Empresa"]["id"] = $id_encriptada;
		}

		$mi_empresa = $this->Empresa->encriptacion($this->miEmpresa());

		$this->set('mi_empresa', $mi_empresa);
		$this->set('empresas', $empresas);
	}
	

//=========================================================================


	public function view($id = null)
	{
		$id = $this->Empresa->desencriptacion($id);

		if (!$this->Empresa->exists($id))
		{
			$this->Session->setFlash('Empresa Inválida.');
			$this->redirect($this->referer());
		}

		$empresa = $this->Empresa->find('first', array(
			'conditions' => array('id' => $id),
			'fields' => array(
				'id', 'nombre', 'activo', 'mail', 'usuarios', 'fecha_corte'
			)
		));

		$this->set('empresa', $empresa);
	}
	

//=========================================================================


	public function add()
	{
		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$guardado = $this->Empresa->guardarEnBDD($data['Empresa'], "agregar");

			if ($guardado != 1)
				$this->Session->setFlash($guardado);
			else
			{
				$this->Flash->setFlash('Empresa guardada exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	

//=========================================================================


	public function edit($id = null)
	{
		$id = $this->Empresa->desencriptacion($id);

		if (!$this->Empresa->exists($id))
		{
			$this->Session->setFlash('Empresa Inválida.');
			$this->redirect($this->referer());
		}

		if ($this->request->is(array('post', 'put')))
		{
			$data = $this->request->data;

			$guardado = $this->Empresa->guardarEnBDD($data['Empresa'], "editar");

			if ($guardado != 1)
				$this->Session->setFlash($guardado);
			else
			{
				$this->Flash->setFlash('Empresa guardada exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}


		$empresa = $this->Empresa->find('first', array(
			'conditions' => array('id' => $id),
			'fields' => array(
				'id', 'nombre', 'mail', 'usuarios', 'fecha_corte'
			)
		));

		$this->set('empresa', $empresa['Empresa']);
	}
	

//=========================================================================


	public function delete($id = null)
	{
		$id = $this->Empresa->desencriptacion($id);

		if (!$this->Empresa->exists($id))
		{
			$this->Session->setFlash('Empresa Inválida.');
			$this->redirect($this->referer());
		}

		$this->Empresa->borrarTodo($id);

		$this->redirect(array('action' => 'index'));
	}
}

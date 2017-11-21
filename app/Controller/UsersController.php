<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class UsersController extends AppController {
	

//=========================================================================


	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('logout', 'registro', 'activar_cuenta');
	}
	

//=========================================================================


	public function isAuthorized($user)
	{
		//Acceso para todos
		if (in_array($this->action, array('login', 'logout', 'registro')))
		{
            return true;
        }

        //Acceso para Admins
        if (in_array($this->action, array('index', 'filtro', 'add', 'edit', 'activar_desactivar')))
        {
            if (isset($user['tipo_user']) && in_array($user['tipo_user'], array("Admin")))
    		{
    			return true;
    		}
        }

	    return parent::isAuthorized($user);
    }
	

//=========================================================================


	public function login()
	{
		$this->layout ="login";

	    if ($this->request->is('post'))
	    {
	    	$valido = $this->User->validarInputs($this->request->data['User']);

			if ($valido != 1)
				$this->Session->setFlash($valido);
			else
			{
				if ($this->Auth->login())
				{
					if ($this->Session->read("Auth.User.tipo_user") == "SA")
						$this->redirect("/empresas/seleccionar");
					else
					{
						if ($this->Session->read("Auth.User.activo") == "0")
						{
							$this->Session->setFlash('Su cuenta esta desactivada.');
							$this->Auth->logout();
						}
						else
						{
							if ($this->Session->read("Auth.User.Empresa.activo") == 0)
							{
								$this->Session->setFlash("Su empresa ha sido desactivada.");
								$this->redirect($this->Auth->logout());
							}
							else
							{
								date_default_timezone_set('America/Mexico_City');
								$hoy = date("d/m/Y");
								$hoy = date_create_from_format("d/m/Y", $hoy);
								$fecha_corte = date_create_from_format("d/m/Y", $this->Session->read("Auth.User.Empresa.fecha_corte"));
								if ($fecha_corte < $hoy)
								{
									$empresa_id = $this->Session->read("Auth.User.empresa_id");
									$this->User->query("
										UPDATE ".$this->nombre_bdd.".empresas
										SET activo = 0
										WHERE id = $empresa_id
									");
									$this->Session->setFlash("Su empresa ha sido desactivada.");
									$this->redirect($this->Auth->logout());
								}

								$this->Session->write("mi_empresa", $this->Session->read("Auth.User.empresa_id"));
							}
						}
					}

		            $this->redirect($this->Auth->redirectUrl());
		        }
				$this->Session->setFlash('Usuario o contraseña inválida.');
			}
	    }
	}
	

//=========================================================================


	public function logout()
	{
		$this->Session->destroy();
	    $this->redirect($this->Auth->logout());
	}
	

//=========================================================================


	public function activar_desactivar()
	{
		$this->layout='ajax';

		$activo = $this->request->data["activo"];
		$usuario_id = $this->request->data["usuario_id"];

		$usuario["User"]["id"] = $usuario_id;

		$usuario_id = $this->User->desencriptacion($usuario_id);

		if ($activo == 1)
			$activo = 0;
		else
			$activo = 1;

		$this->User->query("
			UPDATE ".$this->nombre_bdd.".users
			SET activo = $activo
			WHERE id = $usuario_id
		");

		$usuario["User"]["activo"] = $activo;
		$this->set("usuario", $usuario);
	}
	

//=========================================================================


	public function registro()
	{
		$this->layout ="login";
		$this->loadModel("Empresa");
		
		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$repetido = $this->User->find('count', array(
				'conditions' => array('username' => $data['User']['username'])
			));

			if ($repetido == 0)
			{
				$token = $this->User->token();
				$contra_original = $data['User']['password'];

				$blowF = new BlowfishPasswordHasher();
				$contra_encr = $blowF->hash($contra_original);
				$data['User']['password'] = $contra_encr;
				$data['User']['token'] = $token;

				date_default_timezone_set('America/Mexico_City');
				$hoy = date("d/m/Y");
				$fecha_corte = date('d/m/Y', strtotime(date(). '+ 7 days'));

				$data["Empresa"]["nombre"] = "AUTO - ".$data["Empresa"]["nombre"];
				$data["Empresa"]["usuarios"] = "3";
				$data["Empresa"]["fecha_corte"] = $fecha_corte;

				$guardado = $this->Empresa->guardarEnBDD($data['Empresa'], "agregar");

				if ($guardado != 1)
					$this->Session->setFlash($guardado);
				else
				{
					$empresa_id = $this->Empresa->find('first', array(
						'conditions' => array(
							'nombre' => $data["Empresa"]["nombre"],
							'mail' => $data["Empresa"]["mail"]
						),
						'fields' => array('id')
					));
					$empresa_id = $empresa_id["Empresa"]["id"];

					$data['User']['empresa_id'] = $empresa_id;

					$guardado = $this->User->guardarEnBDD($data['User'], "agregar", "", 0);

					if ($guardado != 1)
						$this->Session->setFlash($guardado);
					else
					{
						$url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER["HTTP_HOST"]."/users/activar_cuenta/$token";

						// Email que se le manda a los administradores para notificarles
						$Email = new CakeEmail();
						$Email->template('default', 'nuevo_cliente');
						$Email->emailFormat('html');
						$Email->config('smtp');
						$Email->to(array("ventas.codecreators@gmail.com", "rodolfo.saldivar@udem.edu"));
						$Email->subject('Pruebas, Nuevo Cliente');
						$Email->viewVars(array(
							'empresa_nombre' => $data["Empresa"]["nombre"],
							'empresa_mail' => $data["Empresa"]["mail"]
						));
						$Email->send();

						// Email que se le manda al usuario para confirmar su cuenta$Email = new CakeEmail();
						$Email->template('default', 'activa_cuenta');
						$Email->emailFormat('html');
						$Email->config('smtp');
						$Email->to($data["Empresa"]["mail"]);
						$Email->subject('Activación de su cuenta, SIPREX.');
						$Email->viewVars(array(
							'usu_username' => $data["User"]["username"],
							'nombre' => $data["User"]["nombre"],
							'a_paterno' => $data["User"]["a_paterno"],
							'a_materno' => $data["User"]["a_materno"],
							'contra' => $contra_original,
							'url' => $url
						));
						$Email->send();

				    	$this->Session->setFlash('Se le mandó un correo electrónico, siga las instrucciones.');

						// $this->Flash->setFlash('Bienvenido, tienes 7 días para probar la plataforma SIPREX.');
						$this->redirect(array('action' => 'index'));
					}
				}
			}
			else
				$this->Session->setFlash('Ese username ya esta ocupado.');
		}
	}
	

//=========================================================================


	public function activar_cuenta($token = null)
	{
		$activado = $this->User->activarCuenta($token);
		
		if ($activado)
		{
			$this->Session->setFlash('Usuario activado correctamente.');
			$this->redirect("/presupuestos");
		}
		else
		{
			$this->Session->setFlash('Usuario inválido.');
			$this->redirect(array('action' => 'login'));
		}
	}
	

//=========================================================================


	public function index()
	{
		$empresa_id = $this->miEmpresa();
		$usuarios = $this->User->todosUsuarios($empresa_id);
		$this->set('usuarios', $usuarios);
	}
	

//=========================================================================


	public function filtro()
	{
		$this->layout='ajax';

		$data = $this->request->data;

		$empresa_id = $this->miEmpresa();
		
		$todo_vacio = false;
		if (empty($data['tipo_user']) &&
			empty($data['username']) &&
			empty($data['nombre_completo']))
		{
			$todo_vacio = true;
		}
		else
		{
			$valido = $this->User->validarBuscador($data);

			if (!$valido)
				$this->set("usuarios", "");
			else
			{
				//Condiciones default
				$condiciones = array(
					'empresa_id' => $empresa_id
				);

				//Agrega la condicion si su campo no esta vacio
				if (!empty($data['tipo_user']))
					$condiciones["CHARINDEX('".$data['tipo_user']."', tipo_user) >"] = "0";

				if (!empty($data['username']))
					$condiciones["CHARINDEX('".$data['username']."', username) >"] = '0';

				if (!empty($data['nombre_completo']))
					$condiciones["CHARINDEX('".$data['nombre_completo']."', CONCAT(a_paterno, ' ', a_materno, ', ', nombre)) >"] = '0';

				//Busca
				$encontrados = $this->User->find('all', array(
					'conditions' => $condiciones,
					'fields' => array(
						'id', "CONCAT(a_paterno, ' ', a_materno, ', ', nombre) as nombre", 'tipo_user', 'username'
					),
					'order' => array('tipo_user', 'nombre')
				));


				//Mete la encriptacion
			    foreach ($encontrados as $key => $usuario)
			    {
			    	$id_encriptada = $this->User->encriptacion($usuario['User']['id']);
			    	$encontrados[$key]['User']['id'] = $id_encriptada;
			    }
			}
		}

	    //Checa que no este todo vacio
		if ($todo_vacio)
			$this->set("usuarios", $this->User->todosUsuarios($empresa_id));
		else
			@$this->set("usuarios", $encontrados);
	}
	

//=========================================================================


	/*public function view($id = null)
	{
		$id = $this->User->desencriptacion($id);
		
		if (!$this->User->exists($id))
		{
			throw new NotFoundException(__('Inválid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}*/
	

//=========================================================================


	public function add()
	{
		$this->loadModel("Empresa");

		$max_usuarios = $this->Empresa->find('first', array(
			'conditions' => array('id' => $this->miEmpresa()),
			'fields' => array('usuarios')
		));
		$max_usuarios = $max_usuarios["Empresa"]["usuarios"];

		$usuarios_actuales = $this->User->find('count', array(
			'conditions' => array('empresa_id' => $this->miEmpresa())
		));

		if ($usuarios_actuales < $max_usuarios)
			$puede_agregar = 1;
		else
			$puede_agregar = 0;


		if ($this->request->is('post'))
		{
			$data = $this->request->data;

			$repetido = $this->User->find('count', array(
				'conditions' => array('username' => $data['User']['username'])
			));

			if ($puede_agregar)
			{
				if ($repetido == 0)
				{
					$blowF = new BlowfishPasswordHasher();
					$contra_encr = $blowF->hash($data['User']['password']);
					$data['User']['password'] = $contra_encr;

					$data['User']['empresa_id'] = $this->miEmpresa();
					$token = $this->User->token();
					$data['User']['token'] = $token;

					$guardado = $this->User->guardarEnBDD($data['User'], "agregar", "");

					if ($guardado != 1)
						$this->Session->setFlash($guardado);
					else
					{
						$this->Flash->setFlash('Usuario guardado exitosamente.');
						$this->redirect(array('action' => 'index'));
					}
				}
				else
					$this->Session->setFlash('Ese username ya esta ocupado.');
			}
		}

		$this->set("puede_agregar", $puede_agregar);
	}
	

//=========================================================================


	public function edit($id = null)
	{
		$id = $this->User->desencriptacion($id);
		
		if (!$this->User->exists($id))
		{
			$this->Session->setFlash('Usuario Inválido.');
			$this->redirect($this->referer());
		}

		if ($this->request->is(array('post', 'put')))
		{
			$data = $this->request->data;

			$repetido = $this->User->find('count', array(
				'conditions' => array('username' => $data['User']['username'])
			));

			$mi_username = $this->User->find('first', array(
				'conditions' => array('id' => $data['User']['id']),
				'fields' => array('username', 'password')
			));

			if ($data['User']['username'] == $mi_username['User']['username'])
				$repetido--;

			if ($repetido == 0)
			{
				if ($data['User']['password'] != $mi_username['User']['password'])
				{
					$blowF = new BlowfishPasswordHasher();
					$contra_encr = $blowF->hash($data['User']['password']);

					$query = " password = '".$contra_encr."', ";
				}
				else
					$query = "";

				$token = $this->User->token();
				$data['User']['token'] = $token;

				$guardado = $this->User->guardarEnBDD($data['User'], "editar", $query);

				if ($guardado != 1)
					$this->Session->setFlash($guardado);
				else
				{
					$this->Flash->setFlash('Usuario guardado exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
			else
				$this->Session->setFlash('Ese username ya esta ocupado.');
		}

		$this->request->data = $this->User->find('first', array(
			'conditions' => array('id' => $id),
			'fields' => array(
				'id', 'nombre', 'a_paterno', 'a_materno', 'tipo_user', 'username', 'password'
			)
		));
	}
}

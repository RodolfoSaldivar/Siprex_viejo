<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {


/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'Empresa' => array(
            'className' => 'Empresa',
            'foreignKey' => 'empresa_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    

//=========================================================================


    public function todosUsuarios($empresa_id)
    {
        $usuarios = $this->find('all', array(
            'conditions' => array(
                'empresa_id' => $empresa_id
            ),
            'fields' => array(
                'id', "CONCAT(a_paterno, ' ', a_materno, ', ', nombre) as nombre", 'tipo_user', 'username', 'activo'
            ),
            'order' => array('tipo_user', 'nombre')
        ));

        foreach ($usuarios as $key => $usuario)
        {
            $id_encriptada = $this->encriptacion($usuario["User"]["id"]);
            $usuarios[$key]["User"]["id"] = $id_encriptada;
        }

        return $usuarios;
    }
    

//=========================================================================


    public function guardarEnBDD($atributos, $accion, $query, $activo = 1)
    {
        $valido = $this->validarInputs($atributos);

        if ($valido != 1)
            return $valido;
        else
        {   
            if ($accion == "agregar")
            {
                $queryExitosa = $this->query("
                    INSERT INTO ".$this->nombre_bdd.".users
                        (empresa_id, tipo_user, nombre, a_paterno, a_materno, username, password, token, activo)
                    VALUES (
                        ".$atributos['empresa_id'].",
                        '".$atributos['tipo_user']."',
                        '".$atributos['nombre']."',
                        '".$atributos['a_paterno']."',
                        '".$atributos['a_materno']."',
                        '".$atributos['username']."',
                        '".$atributos['password']."',
                        '".$atributos['token']."',
                        $activo
                    )
                ");
            }

            if ($accion == "editar")
            {
                $queryExitosa = $this->query("
                    UPDATE ".$this->nombre_bdd.".users
                    SET nombre = '".$atributos['nombre']."',
                        a_paterno = '".$atributos['a_paterno']."',
                        a_materno = '".$atributos['a_materno']."',
                        tipo_user = '".$atributos['tipo_user']."',
                        $query
                        username = '".$atributos['username']."',
                        token = '".$atributos['token']."'
                    WHERE id = ".$atributos['id']."
                ");
            }

            if ($queryExitosa)
            {
                return 1;
            }
            else
                return 'No se pudo guardar.';
        }
    }
    

//=========================================================================


    public function activarCuenta($token)
    {
        $existe = $this->find('first', array(
            'conditions' => array('token' => $token),
            'fields' => 'token'
        ));

        if ($existe)
            $retorno = $this->query("
                UPDATE ".$this->nombre_bdd.".users
                SET activo = 1
                WHERE token = N'$token'
            ");
        else
            $retorno = 0;

        return $retorno;
    }

}

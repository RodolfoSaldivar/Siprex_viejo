<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts.Email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title><?php echo $this->fetch('title'); ?></title>
</head>
<body>

	<p>Hola <?php echo $nombre; ?> <?php echo $a_paterno; ?> <?php echo $a_materno; ?>.</p>

	<p>
		Su usuario ha sido agregado exitosamente.
	</p>
	<p>
		Usuario: <b><?php echo $usu_username; ?></b><br>
		Contraseña: <b><?php echo $contra; ?></b>
	</p>
	<p>
		<b>Para validar su cuenta ingrese a esta dirección:</b>
	</p>

	<a href="<?php echo $url; ?>"><?php echo $url; ?></a>
	<br><br>

	<p>
		¡Gracias por registrarse a SIPREX!
	</p>
	<p>
		Tiene 7 días para probar la plataforma.
	</p>

</body>
</html>
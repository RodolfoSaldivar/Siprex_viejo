

<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>

	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php echo $this->Html->css('materialize.min.css'); ?>
	<?php echo $this->Html->css('style.css'); ?>

	<?php
		echo $this->Html->meta('icon');

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

	
	<ul id='drop_usuario' class='dropdown-content'>

		<?php if (in_array($this->Session->read("Auth.User.tipo_user"), array("SA", "Admin"))): ?>
			<li>
				<a href="/users">Usuarios</a>
			</li>
			<li class="divider"></li>
		<?php endif ?>
			
		<li>
			<a href="/users/logout">Cerrar Sesión</a>
		</li>
	</ul>
	

	<nav id="menu_global">
		<div class="nav-wrapper">

			<!-- opciones usuario para compus -->
			<ul class="right">
				<li>
					<a class='dropdown-button' id="opciones_del_usuario" data-activates='drop_usuario'>
						<i class="material-icons white-text">person</i>
					</a>
				</li>
			</ul>

			<!-- Menu global para compus -->
			<ul id="opciones_menu" class="left hide-on-med-and-down">
				<?php if ($this->Session->read("Auth.User.tipo_user") == "SA"): ?>
					<li id="opcion_empresas">
						<a href="/empresas">Empresas</a>
					</li>
				<?php endif ?>
				<li id="opcion_proyectos">
					<a href="/presupuestos">Proyectos</a>
				</li>
				<li id="opcion_insumos">
					<a href="/insumos">Insumos</a>
				</li>
				<li id="opcion_presupuestos">
					<a href="/presupuestos/view/<?php echo $this->Session->read("presupuesto_id_encr") ?>">
						Presupuesto
					</a>
				</li>
				<li id="opcion_conceptos">
					<a href="/partidas">Conceptos</a>
				</li>
				<li id="opcion_apu">
					<a>Análisis P.U.</a>
				</li>
				<li id="opcion_proveedores">
					<a href="/contactos">Proveedores</a>
				</li>
			</ul>

			<!-- Menu hamburguesa para tablet -->
			<a href="#" data-activates="menu_hamburguesa" class="left button-collapse">
				<i class="material-icons white-text">menu</i>
			</a>
			<ul id="menu_hamburguesa" class="side-nav">
				<ul class="collapsible" data-collapsible="accordion">
					<br>
					<?php if ($this->Session->read("Auth.User.tipo_user") == "SA"): ?>
						<li id="movil_empresas">
							<a href="/empresas">
								<i class="material-icons">domain</i>
								Empresas
							</a>
						</li>	
					<?php endif ?>
					<li id="movil_proyectos">
						<a href="/presupuestos">
							<i class="material-icons">import_contacts</i>
							Proyectos
						</a>
					</li>
					<li id="movil_insumos">
						<a href="/insumos">
							<i class="material-icons">stop</i>
							Insumos
						</a>
					</li>
					<li id="movil_presupuestos">
						<a href="/presupuestos/view/<?php echo $this->Session->read("presupuesto_id_encr") ?>"">
							<i class="material-icons">style</i>
							Presupuesto
						</a>
					</li>
					<li id="movil_conceptos">
						<a href="/partidas">
							<i class="material-icons">view_module</i>
							Conceptos
						</a>
					</li>
					<li id="movil_proveedores">
						<a href="/contactos">
							<i class="material-icons">group</i>
							Proveedores
						</a>
					</li>
				</ul>
			</ul>
		</div>
	</nav>



	<div class="contenedor">

		<?php if ($this->Session->read("presupuesto_id")): ?>
			
			<div class="row" id="bread_presupuesto_nombre">
				<div class="col s12 red-text">
					*Dentro del proyecto: <?php echo $this->Session->read("presupuesto_nombre") ?>
				</div>
			</div>

		<?php endif ?>

		<?php echo $this->fetch('content'); ?>
	</div>


	<a href="#hasta_arriba" class="hasta_arriba">Hasta Arriba</a>
	

	<?php echo $this->Html->script('jquery-2.1.1.min.js'); ?>
	<?php echo $this->Html->script('materialize.min.js'); ?>
	<?php echo $this->Html->script('jquery.validate.min.js'); ?>
	<?php echo $this->Html->script('alphanumeric.js'); ?>
	<?php echo $this->Html->script('dropdown.min.js'); ?>
	<?php echo $this->fetch('script'); ?>

	<script type="text/javascript">

		$.validator.messages.required = '*Requerido';
		$.validator.messages.number = '*Número inválido';
		$.validator.messages.alphanumeric = '*Omitir ("), '+"(')"+', ([), (]) y enters';
		$.validator.messages.email = '*Correo electrónico invalido';
		$.validator.messages.min = '*Igual o mayor a {0}';
		$.validator.messages.step = '*Solo enteros';
		$.validator.messages.maxlength = "*Máximo {0} caracteres.";

		$(document).ready(function(){
			$('.collapsible').collapsible();
			$('.button-collapse').sideNav({
				menuWidth: 300
			});
			$('.dropdown-button').dropdown({
				belowOrigin: true
			});
			$('#opciones_del_usuario').dropdown({
				constrainWidth: true,
				hover: false,
				belowOrigin: true,
				stopPropagation: true
			});
		});

		//Función para regresar el parse Float
		function regresarFloat(numero){
			return parseFloat(String(numero).replace(/[^\d\.]/g,''));
		}

		//Boton de hasta arriba
		$(window).scroll(function() {
			if ( $(window).scrollTop() > $(window).height() ) {
				$('a.hasta_arriba').fadeIn('slow');
			} else {
				$('a.hasta_arriba').fadeOut('slow');
			}
		});

		$('a.hasta_arriba').click(function() {
			$('html, body').animate({
				scrollTop: 0
			}, 700);
			return false;
		});

		<?php echo $this->Session->flash('flash', array(
		    'element' => 'toast'
		)); ?>

		<?php if (!$this->Session->read("presupuesto_id")): ?>
			
			$("#opcion_presupuestos, #movil_presupuestos").addClass('hide');
			$("#opcion_conceptos, #movil_conceptos").addClass('hide');
			$("#opcion_apu").addClass('hide');

		<?php endif ?>

	</script>
</body>
</html>
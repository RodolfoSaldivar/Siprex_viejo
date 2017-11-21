

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

	
	<div class="login_layout contenedor">
		<?php echo $this->fetch('content'); ?>
	</div>
	

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
		$.validator.messages.min = '*Igual o mayor a 0';
		$.validator.messages.step = '*Solo enteros';
		$.validator.messages.maxlength = "*Máximo {0} caracteres.";

		<?php echo $this->Session->flash('flash', array(
		    'element' => 'toast'
		)); ?>

	</script>
</body>
</html>
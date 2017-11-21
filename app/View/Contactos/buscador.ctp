


<a id="btn_buscador" class='dropdown-button btn' data-activates='buscador'>
	<i class="material-icons left">search</i>
	<span class="left">Buscar</span>
</a>

<ul id='buscador' class='dropdown-content'>
	<li>
		<div class="input-field col s10 offset-s1">
			<input type="text" id="filtro_tipo">
			<label for="filtro_tipo">TIPO DE CONTACTO</label>
		</div>
	</li>
	<li>
		<div class="input-field col s10 offset-s1">
			<input type="text" id="filtro_nombre">
			<label for="filtro_nombre">NOMBRE</label>
		</div>
	</li>
	<li>
		<div class="input-field col s10 offset-s1">
			<input type="text" id="filtro_puesto">
			<label for="filtro_puesto">PUESTO</label>
		</div>
	</li>
	<li>
		<div class="input-field col s10 offset-s1">
			<input type="text" id="filtro_rfc">
			<label for="filtro_rfc">RFC</label>
		</div>
	</li>
	<li>
		<div class="input-field col s10 offset-s1">
			<input type="text" id="filtro_correo">
			<label for="filtro_correo">CORREO</label>
		</div>
	</li>
</ul>


<?php $this->Html->script('donetyping', array('inline' => false)); ?>


<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$(document).on('click', '#buscador.dropdown-content', function (e) {
		e.stopPropagation();
	});



	$('#filtro_tipo').donetyping(function()
	{ filtrarResultado(); });
	$('#filtro_nombre').donetyping(function()
	{ filtrarResultado(); });
	$('#filtro_puesto').donetyping(function()
	{ filtrarResultado(); });
	$('#filtro_rfc').donetyping(function()
	{ filtrarResultado(); });
	$('#filtro_correo').donetyping(function()
	{ filtrarResultado(); });

	function filtrarResultado()
	{
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '<?= Router::Url(['controller' => 'Contactos', 'action' => 'filtro']); ?>',
	        success: function(response)
	        {
	            $('#filtro_cambiar').replaceWith(response);
	        },
	        data: {
	        	tipo_contacto: $('#filtro_tipo').val(),
	        	nombre: $('#filtro_nombre').val(),
	        	puesto: $('#filtro_puesto').val(),
	        	rfc: $('#filtro_rfc').val(),
	        	correo: $('#filtro_correo').val()
	        }
	    });
	}

<?php $this->Html->scriptEnd(); ?>
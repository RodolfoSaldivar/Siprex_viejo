


<a id="btn_buscador" class='dropdown-button btn' data-activates='buscador'>
	<i class="material-icons left">search</i>
	<span class="left">Buscar</span>
</a>

<ul id='buscador' class='dropdown-content'>
	<li>
		<div class="input-field col s10 offset-s1">
			<input type="text" id="filtro_tipo">
			<label for="filtro_tipo">TIPO DE USUARIO</label>
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
			<input type="text" id="filtro_username">
			<label for="filtro_username">USERNAME</label>
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
	$('#filtro_username').donetyping(function()
	{ filtrarResultado(); });

	function filtrarResultado()
	{
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '<?= Router::Url(['controller' => 'Users', 'action' => 'filtro']); ?>',
	        success: function(response)
	        {
	            $('#filtro_cambiar').replaceWith(response);
	        },
	        data: {
	        	tipo_user: $('#filtro_tipo').val(),
	        	nombre_completo: $('#filtro_nombre').val(),
	        	username: $('#filtro_username').val()
	        }
	    });
	}

<?php $this->Html->scriptEnd(); ?>
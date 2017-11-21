


<a id="btn_buscador" class='dropdown-button btn' data-activates='buscador'>
	<i class="material-icons left">search</i>
	<span class="left">Buscar</span>
</a>

<ul id='buscador' class='dropdown-content'>
	<li>
		<div class="input-field col s10 offset-s1">
			<input type="text" id="filtro_clave">
			<label for="filtro_clave">ID</label>
		</div>
	</li>
	<li>
		<div class="input-field col s10 offset-s1">
			<input type="text" id="filtro_des">
			<label for="filtro_des">DESCRIPCIÓN</label>
		</div>
	</li>
</ul>


<?php $this->Html->script('donetyping', array('inline' => false)); ?>


<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$(document).on('click', '#buscador.dropdown-content', function (e) {
		e.stopPropagation();
	});



	$('#filtro_clave').donetyping(function()
	{ filtrarResultado(); });
	$('#filtro_des').donetyping(function()
	{ filtrarResultado(); });

	function filtrarResultado()
	{
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '<?= Router::Url(['controller' => 'AnalisisPreciosUs', 'action' => 'filtro']); ?>',
	        success: function(response)
	        {
	            $('#filtro_cambiar').replaceWith(response);
	        },
	        data: {
	        	clave: $('#filtro_clave').val(),
	        	descripcion: $('#filtro_des').val()
	        }
	    });
	}

<?php $this->Html->scriptEnd(); ?>
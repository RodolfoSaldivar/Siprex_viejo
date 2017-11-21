


<a id="btn_buscador" class='dropdown-button btn' data-activates='buscador'>
	<i class="material-icons left">search</i>
	<span class="left">Buscar</span>
</a>

<ul id='buscador' class='dropdown-content'>
	<li>
		<div class="input-field col s10 offset-s1">
			<input type="text" id="filtro_obra">
			<label for="filtro_obra">OBRA</label>
		</div>
	</li>
	<li>
		<div class="input-field col s10 offset-s1">
			<input type="text" id="filtro_colonia">
			<label for="filtro_colonia">COLONIA</label>
		</div>
	</li>
	<li>
		<div class="input-field col s10 offset-s1">
			<input type="text" id="filtro_ubicacion">
			<label for="filtro_ubicacion">UBICACIÓN</label>
		</div>
	</li>
</ul>


<?php $this->Html->script('donetyping', array('inline' => false)); ?>


<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$(document).on('click', '#buscador.dropdown-content', function (e) {
		e.stopPropagation();
	});



	$('#filtro_obra').donetyping(function()
	{ filtrarResultado(); });
	$('#filtro_colonia').donetyping(function()
	{ filtrarResultado(); });
	$('#filtro_ubicacion').donetyping(function()
	{ filtrarResultado(); });

	function filtrarResultado()
	{
		$.ajax({
	        type:'POST',
	        cache: false,
	        url: '<?= Router::Url(['controller' => 'presupuestos', 'action' => 'filtro']); ?>',
	        success: function(response)
	        {
	            $('#filtro_cambiar').replaceWith(response);
	        },
	        data: {
	        	obra: $('#filtro_obra').val(),
	        	colonia: $('#filtro_colonia').val(),
	        	ubicacion: $('#filtro_ubicacion').val()
	        }
	    });
	}

<?php $this->Html->scriptEnd(); ?>
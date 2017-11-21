


<?php echo $this->Form->create(array('type' => 'file')); ?>
	
	<div class="bg_blanco">
		<div class="contenedor">

			<div class="row margin_nada azul_4">
				<div style="padding:10px 0 0 20px; font-size:30px;">
					Plantilla
				</div>
			</div>

			<div class="row margin_nada">
				<div style="padding:10px 0 0 20px; font-size:20px;">
					1 - Descargar el archivo Excel a continuación.<br>
					2 - LLenar los campos que se piden (el archivo cuenta con comentarios de ayuda).<br>
					3 - Escoger el mismo archivo con los datos llenos.<br>
					4 - Enviar el archivo.<br><br>
				</div>
			</div>


			<div class="row">

				<div class="col s6 padding_top">
					<div class="input-field">
						<a href="/insumos/descargar_excel/plantillaInsumos" class="waves-effect waves-light btn">
							Descargar
						</a>
					</div>
				</div>

				<div class="col s6 padding_top">
					<div class="file-field input-field">

						<div class="btn">
							<span>Archivo</span>
							<input name="data[archivo]" type="file">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" style="border-bottom: 1px solid #9e9e9e;">
							<label id="data[archivo]-error" class="error validation_label validation_image" for="data[archivo]"></label>
						</div>
					</div>
				</div>

			</div>


			<div class="row padding_bottom margin_nada hide" id="aparece_loading">
				<div class="col s3 offset-s9 center">
					<div class="preloader-wrapper big active">
						<div class="spinner-layer azul_5">
							<div class="circle-clipper left"><div class="circle"></div></div>
							<div class="gap-patch"><div class="circle"></div></div>
							<div class="circle-clipper right"><div class="circle"></div></div>
						</div>
					</div>
					<br>
					<span class="enviando">
						Guardando Insumos
					</span>
				</div>
			</div>

			<div class="row margin_nada" id="desaparece_loading">
				<div class="col m12">	
					<button class="right btn waves-effect waves-light" type="submit" name="action">
						Terminar
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
			<br>

		</div>
	</div>

<?php echo $this->Form->end(); ?>




<?php $this->Html->scriptStart(array('inline' => false)); ?>

	$("#opcion_insumos").addClass("opcion_seleccionada");

	$.validator.messages.required = '*Requerido';

	$('#InsumoSubirExcelForm').validate({
		rules: {
			'data[archivo]': {
				required: true
			}
		}
	});

	$('#InsumoSubirExcelForm').submit(function(event)
	{
		if ($('#InsumoSubirExcelForm').valid())
		{
			$("#desaparece_loading").addClass("hide");
			$("#aparece_loading").removeClass("hide");
		}
	});

<?php $this->Html->scriptEnd(); ?>
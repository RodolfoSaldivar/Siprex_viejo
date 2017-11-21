

<?php $this->assign('title', 'Seleccionar Empresa');  ?>

<div class="row" style="margin-top: -10%;">
	<div class="card-panel">
		
		<div class="row center blanco" style="font-size:30px;">
			SELECCIONAR EMPRESA
		</div>
		
		<div class="row center blanco">
			Verá la información como si fuera administrador de la empresa que escoga. 
		</div>
		
		<?php echo $this->Form->create() ?>

			<?php echo $this->Form->hidden('id'); ?>

			<div>
				<table class="centered">
					<thead>
						<tr>
							<th>NOMBRE</th>
						</tr>
					</thead>

					<tbody id="filtro_a_cambiar">
						<?php foreach ($empresas as $key => $empresa): ?>
							<tr style="cursor:pointer;" id="empresa_<?php echo $empresa["Empresa"]["id"] ?>">
								<td class="">
									<div class="border_top"></div>
									<?php echo $empresa["Empresa"]["nombre"] ?>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>

		<?php echo $this->Form->end(); ?>
	</div>
</div>

<?php $this->Html->scriptStart(array('inline' => false)); ?>

	<?php foreach ($empresas as $key => $empresa): ?>
		
		$(document).on("click", "#empresa_<?php echo $empresa["Empresa"]["id"] ?>", function()
		{
			$("#EmpresaId").val("<?php echo $empresa["Empresa"]["id"] ?>")
			$("#EmpresaSeleccionarForm").submit();
		});

	<?php endforeach ?>

<?php $this->Html->scriptEnd(); ?>
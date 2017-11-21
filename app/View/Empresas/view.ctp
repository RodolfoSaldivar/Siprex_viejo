<div class="empresas view">
<h2><?php echo __('Empresa'); ?></h2>
	<dl>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($empresa['Empresa']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Empresa'), array('action' => 'edit', $empresa['Empresa']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Borrar Empresa'), array('action' => 'delete', $empresa['Empresa']['id']), array('confirm' => __('Borrar permanentemente la empresa %s?', $empresa['Empresa']['nombre']))); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Empresas'), array('action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Insumos Relacionados'); ?></h3>
	<?php if (!empty($empresa['Insumo'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Tipo Insumo'); ?></th>
		<th><?php echo __('Contacto Id'); ?></th>
		<th><?php echo __('Empresa Id'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th><?php echo __('Tipo'); ?></th>
		<th><?php echo __('Marca'); ?></th>
		<th><?php echo __('Modelo'); ?></th>
		<th><?php echo __('Medida'); ?></th>
		<th><?php echo __('Precio Compra'); ?></th>
		<th><?php echo __('Precio Venta'); ?></th>
		<th><?php echo __('Rendimiento'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($empresa['Insumo'] as $insumo): ?>
		<tr>
			<td><?php echo $insumo['tipo_insumo']; ?></td>
			<td><?php echo $insumo['contacto_id']; ?></td>
			<td><?php echo $insumo['empresa_id']; ?></td>
			<td><?php echo $insumo['descripcion']; ?></td>
			<td><?php echo $insumo['tipo']; ?></td>
			<td><?php echo $insumo['marca']; ?></td>
			<td><?php echo $insumo['modelo']; ?></td>
			<td><?php echo $insumo['medida']; ?></td>
			<td><?php echo $insumo['precio_compra']; ?></td>
			<td><?php echo $insumo['precio_venta']; ?></td>
			<td><?php echo $insumo['rendimiento']; ?></td>
			<td><?php echo $insumo['created']; ?></td>
			<td><?php echo $insumo['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'insumos', 'action' => 'view', $insumo['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'insumos', 'action' => 'edit', $insumo['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'insumos', 'action' => 'delete', $insumo['id']), array('confirm' => __('Are you sure you want to delete # %s?', $insumo['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Insumo'), array('controller' => 'insumos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Usuarios Relacionados'); ?></h3>
	<?php if (!empty($empresa['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Tipo User'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Empresa Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($empresa['User'] as $user): ?>
		<tr>
			<td><?php echo $user['tipo_user']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['empresa_id']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

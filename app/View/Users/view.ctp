<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Tipo de Usuario'); ?></dt>
		<dd>
			<?php echo h($user['User']['tipo_user']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Usuario'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Borrar Usuario'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Borrar permanentemente?'))); ?> </li>
		<li><?php echo $this->Html->link(__('Lista Usuarios'), array('action' => 'index')); ?> </li>
	</ul>
</div>

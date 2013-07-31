<div class="bookMasters form">
<?php echo $this->Form->create('BookMaster'); ?>
	<fieldset>
		<legend><?php echo __('Edit Book Master'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('book_id');
		echo $this->Form->input('claim_id');
		echo $this->Form->input('book_name');
		echo $this->Form->input('book_kana');
		echo $this->Form->input('author_name');
		echo $this->Form->input('author_kana');
		echo $this->Form->input('publisher_name');
		echo $this->Form->input('publisher_kana');
		echo $this->Form->input('publication_date');
		echo $this->Form->input('status');
		echo $this->Form->input('color_id');
		echo $this->Form->input('page');
		echo $this->Form->input('annotation');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BookMaster.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('BookMaster.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Book Masters'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Colors'), array('controller' => 'colors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color'), array('controller' => 'colors', 'action' => 'add')); ?> </li>
	</ul>
</div>

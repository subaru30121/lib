<div class="bookMasters index">
	<h2><?php echo __('Book Masters'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('book_id'); ?></th>
			<th><?php echo $this->Paginator->sort('claim_id'); ?></th>
			<th><?php echo $this->Paginator->sort('book_name'); ?></th>
			<th><?php echo $this->Paginator->sort('book_kana'); ?></th>
			<th><?php echo $this->Paginator->sort('author_name'); ?></th>
			<th><?php echo $this->Paginator->sort('author_kana'); ?></th>
			<th><?php echo $this->Paginator->sort('publisher_name'); ?></th>
			<th><?php echo $this->Paginator->sort('publisher_kana'); ?></th>
			<th><?php echo $this->Paginator->sort('publication_date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('color_id'); ?></th>
			<th><?php echo $this->Paginator->sort('page'); ?></th>
			<th><?php echo $this->Paginator->sort('annotation'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($bookMasters as $bookMaster): ?>
	<tr>
		<td><?php echo h($bookMaster['BookMaster']['id']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['book_id']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['claim_id']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['book_name']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['book_kana']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['author_name']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['author_kana']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['publisher_name']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['publisher_kana']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['publication_date']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['status']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bookMaster['Color']['code'], array('controller' => 'colors', 'action' => 'view', $bookMaster['Color']['id'])); ?>
		</td>
		<td><?php echo h($bookMaster['BookMaster']['page']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['annotation']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['created']); ?>&nbsp;</td>
		<td><?php echo h($bookMaster['BookMaster']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $bookMaster['BookMaster']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bookMaster['BookMaster']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bookMaster['BookMaster']['id']), null, __('Are you sure you want to delete # %s?', $bookMaster['BookMaster']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Book Master'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Colors'), array('controller' => 'colors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color'), array('controller' => 'colors', 'action' => 'add')); ?> </li>
	</ul>
</div>

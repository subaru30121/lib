<div class="bookMasters view">
<h2><?php  echo __('Book Master'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Book Id'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['book_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Claim Id'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['claim_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Book Name'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['book_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Book Kana'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['book_kana']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Author Name'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['author_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Author Kana'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['author_kana']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publisher Name'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['publisher_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publisher Kana'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['publisher_kana']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publication Date'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['publication_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bookMaster['Color']['code'], array('controller' => 'colors', 'action' => 'view', $bookMaster['Color']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['page']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Annotation'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['annotation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Book Master'), array('action' => 'edit', $bookMaster['BookMaster']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Book Master'), array('action' => 'delete', $bookMaster['BookMaster']['id']), null, __('Are you sure you want to delete # %s?', $bookMaster['BookMaster']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Book Masters'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book Master'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Colors'), array('controller' => 'colors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color'), array('controller' => 'colors', 'action' => 'add')); ?> </li>
	</ul>
</div>

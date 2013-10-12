<h2>蔵書点検</h2>

<?php echo $this->Form->create('BookMaster'); ?>

<?php echo $this->Form->input('book_id', array('type' => 'text', 'label' => '蔵書番号')); ?>
<?php echo $this->Form->end('点検'); ?>
<br />
<?php if(!empty($data)) : ?>
<p>以下の蔵書が点検されました</p>
	<dl>
		<dt>蔵書番号<dt>
		<dd>
			<?php echo $data['BookMaster']['book_id']; ?>
			&nbsp;
		</dd>
		<dt>蔵書名</dt>
		<dd>
			<?php echo $data['BookMaster']['book_name']; ?>
			&nbsp;
		</dd>	
	</dl>
<?php endif; ?>
<br />
<?php echo $this->Html->link('キャンセルする', array('action' => 'checking_return')); ?><br />
<?php echo $this->Html->link('始めから点検を始める', array('action' => 'checking_init')); ?><br />
<?php echo $this->Html->link('未点検一覧', array('action' => 'no_checked')); ?>

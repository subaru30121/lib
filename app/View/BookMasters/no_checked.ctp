<h2>点検管理</h2>

<?php echo $this->Paginator->counter(array('model' => 'BookMaster', 'format' => '未点検のデータがが{:count}件見つかりました')); ?><br />
<?php echo $this->Paginator->counter(array('model' => 'BookMaster', 'format' => '現在、{:start}件目から{:end}件目まで表示しています')); ?>

<table>
<tr>
		<th><?php echo $this->Paginator->sort('id', "ID"); ?></th>
		<th><?php echo $this->Paginator->sort('book_id', "図書番号"); ?></th>
		<th><?php echo $this->Paginator->sort('claim_id', "請求番号"); ?></th>
		<th><?php echo $this->Paginator->sort('book_name', "蔵書名"); ?></th>
		<th><?php echo $this->Paginator->sort('author_name', "著者名"); ?></th>
		<th><?php echo $this->Paginator->sort('color_id', "シールの色"); ?></th>
</tr>
<?php
foreach ($bookMasters as $bookMaster): ?>
<?php //debug($bookMaster); ?>
<tr>
	<td><?php echo h($bookMaster['BookMaster']['id']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['book_id']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['claim_id']); ?>&nbsp;</td>
	<td><?php echo $this->Html->link(h($bookMaster['BookMaster']['book_name']), array('action' => 'view', h($bookMaster['BookMaster']['id']))); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['author_name']); ?>&nbsp;</td>
	<td><p style="background:<?php echo $bookMaster['Color']['code']; ?>"><?php echo $bookMaster['Color']['code']; ?></p><p style="background:<?php echo $bookMaster['Color2']['code']; ?>"><?php echo $bookMaster['Color2']['code']; ?></p></td>
</tr>
<?php endforeach; ?>
</table>

<?php echo $this->Paginator->prev('<< 戻る'); ?> 
<?php echo $this->Paginator->numbers(); ?> 
<?php echo $this->Paginator->next('次へ >>'); ?>

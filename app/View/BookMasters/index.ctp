<h2>蔵書管理</h2>

<?php echo $this->Paginator->counter(array('model' => 'BookMaster', 'format' => '該当するデータが{:count}件見つかりました')); ?><br />
<?php echo $this->Paginator->counter(array('model' => 'BookMaster', 'format' => '現在、{:start}件目から{:end}件目まで表示しています')); ?>

<table>
<tr>
		<th><?php echo $this->Paginator->sort('id', "ID"); ?></th>
		<th><?php echo $this->Paginator->sort('book_id', "図書番号"); ?></th>
		<th><?php echo $this->Paginator->sort('claim_id', "請求番号"); ?></th>
		<th><?php echo $this->Paginator->sort('book_name', "蔵書名"); ?></th>
		<th><?php echo $this->Paginator->sort('book_kana', "蔵書かな"); ?></th>
		<th><?php echo $this->Paginator->sort('author_name', "著者名"); ?></th>
		<th><?php echo $this->Paginator->sort('author_kana', "著者かな"); ?></th>
		<th><?php echo $this->Paginator->sort('publisher_name', "出版社"); ?></th>
		<th><?php echo $this->Paginator->sort('publisher_kana', "出版社かな"); ?></th>
		<th><?php echo $this->Paginator->sort('publication_date', "発行年"); ?></th>
		<th><?php echo $this->Paginator->sort('status', "状態"); ?></th>
		<th><?php echo $this->Paginator->sort('color_id', "シールの色"); ?></th>
		<th><?php echo $this->Paginator->sort('page', "ページ数"); ?></th>
		<th><?php echo $this->Paginator->sort('annotation', "注釈"); ?></th>
		<th><?php echo $this->Paginator->sort('created', "登録日時"); ?></th>
		<th><?php echo $this->Paginator->sort('modified', "更新日時"); ?></th>
</tr>
<?php
foreach ($bookMasters as $bookMaster): ?>
<tr>
	<td><?php echo h($bookMaster['BookMaster']['id']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['book_id']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['claim_id']); ?>&nbsp;</td>
	<td><?php echo $this->Html->link(h($bookMaster['BookMaster']['book_name']), array('action' => 'view', h($bookMaster['BookMaster']['id']))); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['book_kana']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['author_name']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['author_kana']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['publisher_name']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['publisher_kana']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['publication_date']); ?>&nbsp;</td>
	<td><?php echo $bookMaster['BookMaster']['status']; ?>&nbsp;</td>
	<td><?php echo $bookMaster['Color']['code']; ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['page']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['annotation']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['created']); ?>&nbsp;</td>
	<td><?php echo h($bookMaster['BookMaster']['modified']); ?>&nbsp;</td>
</tr>
<?php endforeach; ?>
</table>

<?php echo $this->Paginator->prev('<< 戻る'); ?> 
<?php echo $this->Paginator->numbers(); ?> 
<?php echo $this->Paginator->next('次へ >>'); ?>

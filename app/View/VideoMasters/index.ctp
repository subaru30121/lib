<h2>映像管理</h2>

<?php echo $this->Paginator->counter(array('model' => 'VideoMaster', 'format' => '該当するデータが{:count}件見つかりました')); ?><br />
<?php echo $this->Paginator->counter(array('model' => 'VideoMaster', 'format' => '現在、{:start}件目から{:end}件目まで表示しています')); ?>

<table>
<tr>
		<th><?php echo $this->Paginator->sort('id', "ID"); ?></th>
		<th><?php echo $this->Paginator->sort('title', "タイトル"); ?></th>
		<th><?php echo $this->Paginator->sort('title_kana', "タイトルかな"); ?></th>
		<th><?php echo $this->Paginator->sort('time', "録画時間(分)"); ?></th>
		<th><?php echo $this->Paginator->sort('location', "格納場所"); ?></th>
		<th><?php echo $this->Paginator->sort('status', "状態"); ?></th>
		<th><?php echo $this->Paginator->sort('created', "登録日時"); ?></th>
		<th><?php echo $this->Paginator->sort('modified', "更新日時"); ?></th>
</tr>
<?php
foreach ($videoMasters as $videoMaster): ?>
<tr>
	<td><?php echo h($videoMaster['VideoMaster']['id']); ?>&nbsp;</td>
	<td><?php echo $this->Html->link(h($videoMaster['VideoMaster']['title']), array('action' => 'view', h($videoMaster['VideoMaster']['id']))); ?>&nbsp;</td>
	<td><?php echo h($videoMaster['VideoMaster']['title_kana']); ?>&nbsp;</td>
	<td><?php echo h($videoMaster['VideoMaster']['time']); ?>&nbsp;</td>
	<td><?php echo h($videoMaster['VideoMaster']['location']); ?>&nbsp;</td>
	<td><?php echo $videoMaster['VideoMaster']['status']; ?>&nbsp;</td>
	<td><?php echo h($videoMaster['VideoMaster']['created']); ?>&nbsp;</td>
	<td><?php echo h($videoMaster['VideoMaster']['modified']); ?>&nbsp;</td>
</tr>
<?php endforeach; ?>
</table>

<?php echo $this->Paginator->prev('<< 戻る'); ?> 
<?php echo $this->Paginator->numbers(); ?> 
<?php echo $this->Paginator->next('次へ >>'); ?> 

<!-- 検索フォーム -->
<?php echo $this->Form->create('BookMaster'); ?>
<?php echo $this->Form->input('book_name', array('label' => '蔵書名')); ?>
<?php echo $this->Form->error('Search.book_name'); ?>
<?php echo $this->Form->input('author_name', array('label' => '著者名')); ?>
<?php echo $this->Form->error('Search.author_name'); ?>
<p>発行年(西暦)　　<?php echo $this->Form->year('publication_date_start', MIN_YEAR, date('Y')); ?>　年以上　<?php echo $this->Form->year('publication_date_end', MIN_YEAR, date('Y')); ?>　年以下</p>
<?php echo $this->Form->end('検索開始'); ?>
<?php echo $this->Form->error('Search.publication_date_start'); ?>
<?php echo $this->Form->error('Search.publication_date_end'); ?>
<?php echo $this->Html->link('蔵書検索', array('action' => 'index')); ?> 
<?php echo $this->Html->link('映像検索', array('action' => 'index_video')); ?>
<br />
<!-- 検索フォームここまで -->
</div> <!-- #header -->
<div id="content">
<?php echo $this->Paginator->counter(array('model' => 'BookMaster', 'format' => '該当するデータが{:count}件見つかりました')); ?><br />
<?php echo $this->Paginator->counter(array('model' => 'BookMaster', 'format' => '現在、{:start}件目から{:end}件目まで表示しています')); ?>
<table>
<tr>
	<th><?php echo $this->Paginator->sort('book_kana', "蔵書名"); ?></th>
	<th><?php echo $this->Paginator->sort('author_kana', "著者名"); ?></th>
	<th><?php echo $this->Paginator->sort('publication_date', "発行年"); ?></th>
	<th><?php echo $this->Paginator->sort('color_id', "シールの色"); ?></th>
</tr>
<?php foreach ($bookMasters as $bookMaster): ?>
<tr>
	<td><?php echo $this->Html->link(h($bookMaster['BookMaster']['book_name']), array('action' => 'view', $bookMaster['BookMaster']['id'])); ?></td>
	<td><?php echo h($bookMaster['BookMaster']['author_name']); ?></td>
	<td>
	<?php if(!empty($bookMaster['BookMaster']['publication_date']) && $bookMaster['BookMaster']['publication_date'] != '0000-00-00') : ?>
	<?php echo $this->Time->format('Y', $bookMaster['BookMaster']['publication_date']); ?>
	<?php endif; ?>
	</td>
	<td>
		<p style="background:<?php echo $bookMaster['Color']['code']; ?>"><?php echo $bookMaster['Color']['code']; ?></p>
		<p style="background:<?php echo $bookMaster['Color2']['code']; ?>"><?php echo $bookMaster['Color2']['code']; ?></p>
	</td>
</tr>
<?php endforeach; ?>
</table>
<?php echo $this->Paginator->prev('<< 戻る'); ?> 
<?php echo $this->Paginator->numbers(); ?> 
<?php echo $this->Paginator->next('次へ >>'); ?> 
<br /><br />

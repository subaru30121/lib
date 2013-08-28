<!-- 検索フォーム -->
<?php echo $this->Form->create('VideoMaster'); ?>
<?php echo $this->Form->input('title', array('label' => 'タイトル')); ?>
<?php echo $this->Form->error('Search.title'); ?>
<?php echo $this->Form->end('検索開始'); ?>
<?php echo $this->Html->link('蔵書検索', array('action' => 'index')); ?> 
<?php echo $this->Html->link('映像検索', array('action' => 'index_video')); ?>
<br />
<!-- 検索フォームここまで -->
</div> <!-- #header -->
<div id="content">
<?php echo $this->Paginator->counter(array('model' => 'VideoMaster', 'format' => '該当するデータが{:count}件見つかりました')); ?><br />
<?php echo $this->Paginator->counter(array('model' => 'VideoMaster', 'format' => '現在、{:start}件目から{:end}件目まで表示しています')); ?>
<table>
<tr>
	<th><?php echo $this->Paginator->sort('title', "タイトル"); ?></th>
	<th><?php echo $this->Paginator->sort('time', "録画時間(分)"); ?></th>
</tr>
<?php foreach ($videoMasters as $videoMaster): ?>
<tr>
	<td><?php echo $this->Html->link(h($videoMaster['VideoMaster']['title']), array('action' => 'view_video', $videoMaster['VideoMaster']['id'])); ?></td>
	<td><?php echo h($videoMaster['VideoMaster']['time']); ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php echo $this->Paginator->prev('<< 戻る'); ?> 
<?php echo $this->Paginator->numbers(); ?> 
<?php echo $this->Paginator->next('次へ >>'); ?> 
<br /><br />

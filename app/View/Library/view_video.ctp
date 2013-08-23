<!-- 検索フォーム -->
<?php echo $this->Form->create('VideoMaster'); ?>
<?php echo $this->Form->input('title', array('label' => 'タイトル')); ?>
<?php echo $this->Form->error('Search.title'); ?>
<?php echo $this->Form->end('検索開始'); ?>
<?php echo $this->Html->link('蔵書検索', array('action' => 'index')); ?> 
<?php echo $this->Html->link('映像検索', array('action' => 'index_video')); ?>
<!-- 検索フォームここまで -->
</div> <!-- #header -->
<div id="content">
<h2>映像詳細</h2>
	<dl>
		<dt>タイトル</dt>
		<dd>
			<?php echo h($videoMaster['VideoMaster']['title']); ?>
			&nbsp;
		</dd>
		<dt>録画時間(分)</dt>
		<dd>
			<?php echo h($videoMaster['VideoMaster']['time']); ?>
			&nbsp;
		</dd>
		<dt>格納場所</dt>
		<dd>
			<?php echo h($videoMaster['VideoMaster']['location']); ?>
			&nbsp;
		</dd>	
	</dl>
</div>

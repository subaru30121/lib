<?php echo $this->Form->create('VideoMaster'); ?>
<?php echo $this->Form->input('title', array('label' => 'タイトル')); ?>
<?php echo $this->Form->error('Search.title'); ?>
<?php echo $this->Form->end('検索開始'); ?>
<?php echo $this->Html->link('蔵書検索', array('action' => 'index')); ?> 
<?php echo $this->Html->link('映像検索', array('action' => 'index_video')); ?>
<?php echo $this->Session->flash(); ?>
</div> <!-- #header -->
<div id="content">
ここに検索結果が表示されます。

<?php echo $this->Form->create('BookMaster'); ?>
<?php echo $this->Form->input('book_name', array('label' => '蔵書名')); ?>
<?php echo $this->Form->error('Search.book_name'); ?>
<?php echo $this->Form->input('author_name', array('label' => '著者名')); ?>
<?php echo $this->Form->error('Search.author_name'); ?>
<p>発行年(西暦)　　<?php echo $this->Form->year('publication_date_start', MIN_YEAR, date('Y')); ?>　年以上　<?php echo $this->Form->year('publication_date_end', MIN_YEAR, date('Y')); ?>　年以下</p>
<?php echo $this->Form->end('検索開始'); ?>
			<!-- リンク表示 -->
			<?php echo $this->HTML->link('トップページ', array('controller' => 'library', 'action' => 'index')); ?><br />
<?php echo $this->Form->error('Search.publication_date_start'); ?>
<?php echo $this->Form->error('Search.publication_date_end'); ?>
<?php echo $this->Session->flash(); ?>
</div> <!-- #header -->
<div id="content">
ここに検索結果が表示されます。

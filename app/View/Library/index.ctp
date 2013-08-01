<h2>検索ページ</h2>

<?php echo $this->Form->create('bookMaster'); ?>
<?php echo $this->Form->input('book_name', array('label' => '蔵書名')); ?>
<?php echo $this->Form->error('Search.book_name'); ?>
<?php echo $this->Form->input('author_name', array('label' => '著者名')); ?>
<?php echo $this->Form->error('Search.author_name'); ?>
<p>発行年(西暦)　　<?php echo $this->Form->year('publication_date_start', MIN_YEAR, date('Y')); ?>　年から　<?php echo $this->Form->year('publication_date_end', MIN_YEAR, date('Y')); ?>　年まで</p>
<?php echo $this->Form->error('Search.publication_date_start'); ?>
<?php echo $this->Form->error('Search.publication_date_end'); ?>
<br />
<?php echo $this->Form->end('検索開始'); ?>

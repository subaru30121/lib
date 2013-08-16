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
<!-- 検索フォームここまで -->
</div> <!-- #header -->
<div id="content">
<h2>蔵書詳細</h2>
	<dl>
		<dt>書籍名</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['book_name']); ?>
			&nbsp;
		</dd>
		<dt>著者名</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['author_name']); ?>
			&nbsp;
		</dd>
		<dt>出版社</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['publisher_name']); ?>
			&nbsp;
		</dd>
		<dt>発行年月</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['publication_date']); ?>
			&nbsp;
		</dd>
		<dt>シールの色</dt>
		<dd>
			<?php echo $bookMaster['Color']['code']; ?>
			&nbsp;
		</dd>
		<dt>分類</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['category']); ?>
			&nbsp;
		</dd>
		<dt>ページ数</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['page']); ?>
			&nbsp;
		</dd>
		<dt>注記</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['annotation']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

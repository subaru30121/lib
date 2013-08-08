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

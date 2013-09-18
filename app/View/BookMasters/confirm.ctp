<div class="bookMasters confirm">
<h2>蔵書詳細</h2>
	<dl>
		<dt>図書ID</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['book_id']); ?>
			&nbsp;
		</dd>
		<dt>請求番号</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['claim_id']); ?>
			&nbsp;
		</dd>
		<dt>蔵書名</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['book_name']); ?>
			&nbsp;
		</dd>
		<dt>蔵書名かな</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['book_kana']); ?>
			&nbsp;
		</dd>
		<dt>著者名</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['author_name']); ?>
			&nbsp;
		</dd>
		<dt>著者名かな</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['author_kana']); ?>
			&nbsp;
		</dd>
		<dt>出版社名</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['publisher_name']); ?>
			&nbsp;
		</dd>
		<dt>出版社名かな</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['publisher_kana']); ?>
			&nbsp;
		</dd>
		<dt>出版年</dt>
		<dd>
			<?php echo $bookMaster['BookMaster']['publication_date']['year']; ?>-<?php echo $bookMaster['BookMaster']['publication_date']['month']; ?>-<?php echo $bookMaster['BookMaster']['publication_date']['day']; ?>
			&nbsp;
		</dd>
		<dt>シールの色</dt>
		<dd>
			<span style="background:<?php echo $bookMaster['Color']['code']; ?>">
			<?php echo $bookMaster['Color']['code']; ?>
			</span>
			<span style="background:<?php echo $bookMaster['Color']['code_2']; ?>">
			<?php echo $bookMaster['Color']['code_2']; ?>
			</span>
			&nbsp;
		</dd>
		<dt>分類</dt>
		<dd>
			<?php echo $bookMaster['BookMaster']['category']; ?>
			&nbsp;
		</dd>
		<dt>ページ数</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['page']); ?>
			&nbsp;
		</dd>
		<dt>注釈</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['annotation']); ?>
			&nbsp;
		</dd>
	</dl>

	<?php echo $this->Html->link('戻る', array('action' => $back)); ?>
	<?php echo $this->Html->link('登録', array('action' => 'book_save')); ?>
</div>


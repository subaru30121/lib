<div class="bookMasters view">
<h2>蔵書詳細</h2>
	<dl>
		<dt>蔵書ID</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['id']); ?>
			&nbsp;
		</dd>
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
			<?php echo h($bookMaster['BookMaster']['publication_date']); ?>
			&nbsp;
		</dd>
		<dt>分類</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['category']); ?>
			&nbsp;
		</dd>
		<dt>状態</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['status']); ?>
			&nbsp;
		</dd>
		<dt>シールの色</dt>
		<dd>
			<?php echo $bookMaster['Color']['code']; ?>
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
		<dt>作成日時</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['created']); ?>
			&nbsp;
		</dd>
		<dt>更新日時</dt>
		<dd>
			<?php echo h($bookMaster['BookMaster']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3>操作</h3>
	<ul>
		<li><?php echo $this->Html->link('蔵書編集', array('action' => 'edit', $bookMaster['BookMaster']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink('蔵書破棄', array('action' => 'delete', $bookMaster['BookMaster']['id']), null, '本当に蔵書を消してもいいですか？'); ?> </li>
		<li><?php echo $this->Html->link('蔵書一覧', array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('蔵書追加', array('action' => 'add')); ?> </li>
	</ul>
</div>

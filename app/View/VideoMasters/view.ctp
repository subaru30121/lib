<div class="videoMasters view">
<h2>映像詳細</h2>
	<dl>
		<dt>映像ID</dt>
		<dd>
			<?php echo h($videoMaster['VideoMaster']['id']); ?>
			&nbsp;
		</dd>
		<dt>タイトル</dt>
		<dd>
			<?php echo h($videoMaster['VideoMaster']['title']); ?>
			&nbsp;
		</dd>
		<dt>タイトルかな</dt>
		<dd>
			<?php echo h($videoMaster['VideoMaster']['title_kana']); ?>
			&nbsp;
		</dd>
		<dt>格納場所</dt>
		<dd>
			<?php echo h($videoMaster['VideoMaster']['location']); ?>
			&nbsp;
		</dd>
		<dt>状態</dt>
		<dd>
			<?php echo h($videoMaster['VideoMaster']['status']); ?>
			&nbsp;
		</dd>
		<dt>作成日時</dt>
		<dd>
			<?php echo h($videoMaster['VideoMaster']['created']); ?>
			&nbsp;
		</dd>
		<dt>更新日時</dt>
		<dd>
			<?php echo h($videoMaster['VideoMaster']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3>操作</h3>
	<ul>
		<li><?php echo $this->Html->link('映像編集', array('action' => 'edit', $videoMaster['VideoMaster']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink('映像破棄', array('action' => 'delete', $videoMaster['VideoMaster']['id']), null, '本当に	映像を消してもいいですか？'); ?> </li>
		<li><?php echo $this->Html->link('映像一覧', array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('映像追加', array('action' => 'add')); ?> </li>
	</ul>
</div>

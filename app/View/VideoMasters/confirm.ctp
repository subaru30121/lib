<div class="videoMasters confirm">
<h2>映像確認</h2>
	<dl>
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

	<?php echo $this->Html->link('戻る', array('action' => $back)); ?>
	<?php echo $this->Html->link('登録', array('action' => 'save')); ?>
</div>


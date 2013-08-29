<h2>ログイン履歴</h2>

<p>最新5件を表示しています。</p>

<ul>
	<?php foreach($histories as $history) : ?>
	<li><?php echo $history['Login']['date'] ?>
	<?php endforeach; ?>
</ul>

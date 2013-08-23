<?php echo $this->Html->script('cpick.js'); ?>
<?php echo $this->Html->script('rendering-mode.js'); ?>
<h2>映像登録</h2>
<p>※タイトルは必須項目です</p>
<?php echo $this->Form->create('VideoMaster'); ?>
	<?php
		echo $this->Form->input('title', array('label' => '[タイトル]'));
		echo $this->Form->input('title_kana', array('label' => 'タイトルかな'));
		echo $this->Form->input('location', array('label' => '格納場所'));	
	?>
<?php echo $this->Form->end('登録'); ?>

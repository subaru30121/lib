<?php echo $this->Form->create(); ?>
	<fieldset>
		<legend>映像編集</legend>
	<?php
                echo $this->Form->input('title', array('label' => '[タイトル]'));
                echo $this->Form->input('title_kana', array('label' => 'タイトルかな'));
                echo $this->Form->input('location', array('label' => '格納場所'));
	?>
	</fieldset>
<?php echo $this->Form->end('編集'); ?>

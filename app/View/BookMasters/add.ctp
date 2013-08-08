<h2>蔵書登録</h2>
<?php echo $this->Form->create(); ?>
	<?php
		echo $this->Form->input('book_id');
		echo $this->Form->input('claim_id');
		echo $this->Form->input('book_name');
		echo $this->Form->input('book_kana');
		echo $this->Form->input('author_name');
		echo $this->Form->input('author_kana');
		echo $this->Form->input('publisher_name');
		echo $this->Form->input('publisher_kana');
		echo $this->Form->input('publication_date');
		echo $this->Form->input('status');
		echo $this->Form->input('color.code');
		echo $this->Form->input('page');
		echo $this->Form->input('annotation');
	?>
<?php echo $this->Form->end('登録'); ?>

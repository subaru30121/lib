<?php echo $this->Html->script('cpick.js'); ?>
<?php echo $this->Html->script('cback.js'); ?>
<?php echo $this->Html->script('rendering-mode.js'); ?>
<h2>蔵書登録</h2>
<p>※図書番号と請求番号と蔵書名は必須項目です</p>
<?php echo $this->Form->create('BookMaster'); ?>
	<?php
		echo $this->Form->input('book_id', array('type' => 'text', 'label' => '[図書番号　※必須]'));
		echo $this->Form->input('claim_id', array('type' => 'text', 'label' => '[請求番号　※必須]'));
		echo $this->Form->input('book_name', array('label' => '[蔵書名　※必須]'));
		echo $this->Form->input('book_kana', array('label' => '蔵書名かな'));
		echo $this->Form->input('author_name', array('label' => '著者名'));
		echo $this->Form->input('author_kana', array('label' => '著者名かな'));
		echo $this->Form->input('publisher_name', array('label' => '出版社名'));
		echo $this->Form->input('publisher_kana', array('label' => '出版社名かな'));
		echo $this->Form->input('publication_date', array('type' => 'datetime', 'dateFormat' => 'YMD', 'timeFormat' => 'none', 'monthNames' => false, 'minYear' => MIN_YEAR, 'maxYear' => date('Y'), 'empty' => true, 'label' => '発行年'));
		if (!empty($this->request->data)) echo $this->Form->input('category', array('label' => '分類'));
		// echo $this->Form->input('Color.code', array('type' => 'text', 'label' => 'シールの色（#RRGGBBと入力して下さい）', 'class' => 'html5jp-cpick [coloring:true]', 'id' => 't2', 'name' => 't2', ));
		echo '<div class="input select">';
		echo $this->Form->input('color_id', array('type' => 'select', 'div' => false, 'label' => 'シールの色', 'options' => $colors, 'empty' => '未選択', 'onMouseOut' => 'color()'));
		echo '&nbsp;';
		echo $this->Form->input('color_id_2', array('type' => 'select', 'div' => false, 'label' => false, 'options' => $colors, 'empty' => '未選択', 'onMouseOut' => 'color()'));
		echo '</div>';
		echo $this->Form->input('page', array('type' => 'text', 'label' => 'ページ数'));
		echo $this->Form->input('annotation', array('type' => 'textarea', 'label' => '注釈'));
	?>
<?php echo $this->Form->end('登録'); ?>

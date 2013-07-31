<?php
echo $this->Form->create();
echo $this->Form->inputs(array(
	'legend' => __('ログイン'),
	'username',
	'password'
));
// エラー表示
echo $this->Session->flash("auth");
echo $this->Form->end('ログイン');
?>

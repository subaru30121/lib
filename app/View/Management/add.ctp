<h1>ユーザ登録</h1>

<?php echo $this->Form->create(); ?>
<?php echo $this->Form->input('User.username', array('label'=>'ユーザ名')); ?>
<?php echo $this->Form->input('User.new_password', array('type'=>'password', 'label'=>'パスワード')); ?>
<?php echo $this->Form->input('User.confirm_password', array('type'=>'password', 'label'=>'確認のためもう一度パスワードを入力してください')); ?>
<?php echo $this->Form->input('User.group_id', array('type' => 'select', 'options' => $selectBox, 'label'=>'グループ')); ?>
<?php echo $this->Form->end('登録'); ?>

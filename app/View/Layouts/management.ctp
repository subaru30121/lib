<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Expires" content="Thu, 01 Dec 1994 16:00:00 GMT">
</head>
<body>
	<div id="container">
		<div id="header">
			<div id="title">
				<?php echo $this->Html->image('title.png'); ?>
			</div> <!-- #title -->
			<div id="menu">
							<!-- リンク表示 -->
			<div id="menuLog">
			<?php echo $this->HTML->link('トップページ', array('controller' => 'management', 'action' => 'index')); ?><br />
			<?php echo $this->HTML->link('ログイン', array('controller' => 'management', 'action' => 'login')); ?><br />
			<?php echo $this->HTML->link('ログアウト', array('controller' => 'management', 'action' => 'logout')); ?><br />
			</div>
			<div id="menuUserGroup">
			<?php echo $this->HTML->link('ユーザ登録', array('controller' => 'management', 'action' => 'add_user')); ?><br />
			<?php echo $this->HTML->link('ユーザ一覧', array('controller' => 'management', 'action' => 'select_user')); ?><br />
			<?php // グループはデバック時のみ ?>
			<?php if (Configure::read('debug') > 0) : ?>
			<?php echo $this->HTML->link('グループ登録', array('controller' => 'management', 'action' => 'add_group')); ?><br />
			<?php echo $this->HTML->link('グループ一覧', array('controller' => 'management', 'action' => 'select_group')); ?><br />
			<?php endif; ?>
			</div>
			<div id="menuBock">
			<?php echo $this->HTML->link('蔵書登録', array('controller' => 'bookMasters', 'action' => 'add')); ?><br />
			<?php echo $this->HTML->link('蔵書一覧', array('controller' => 'bookMasters', 'action' => 'index')); ?> <br />
			</div>
			<div id="menuVideo">
			<?php echo $this->HTML->link('映像登録', array('controller' => 'videoMasters', 'action' => 'add')); ?><br />
			<?php echo $this->HTML->link('映像一覧', array('controller' => 'videoMasters', 'action' => 'index')); ?><br />
			</div>
			<div id="menuCheck">
			<?php echo $this->HTML->link('点検', array('controller' => 'bookMasters', 'action' => 'checking')); ?><br />
			</div>
			</div> <!-- #menu -->
		</div> <!-- #header -->
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			<!-- ここが本文 -->
			<?php echo $this->fetch('content'); ?>
			<?php echo $this->session->flash('auth'); ?>
		</div> <!-- #content -->
		<?php echo $this->element('sql_dump'); ?>
		<div id="footer"></div>
	</div> <!-- #container -->
</body>
</html>

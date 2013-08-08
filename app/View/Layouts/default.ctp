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
</head>
<body>
	<div id="container">
		<div id="header">
			
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			<!-- ここが本文 -->
			<?php echo $this->fetch('content'); ?>
			<!-- リンク表示 -->
			<?php echo $this->HTML->link('トップページ', array('controller' => 'library', 'action' => 'index')); ?><br />
		</div>
		<?php echo $this->element('sql_dump'); ?>
	</div>
</body>
</html>

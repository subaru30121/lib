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
</head>
<body id="default">
	<div id="container">
		<div id="header">
			<div id="title">
				<?php echo $this->Html->image('title_d.png'); ?>
			</div> <!-- #title -->
			<div id="clear"></div>
			<!-- ここが本文 -->
			<?php echo $this->fetch('content'); ?>
		</div> <!-- #content -->
		<?php echo $this->element('sql_dump'); ?>
		<div id="footer"></div>
	</div>
</body>
</html>

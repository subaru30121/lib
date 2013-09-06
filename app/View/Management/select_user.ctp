<?php echo $this->Html->script(array('jquery.simple-table-filter.js', 'table.js')); ?>
<?php echo $this->Html->css('table.css'); ?>
<h1>ユーザ一覧</h1>

<dl class="filters">
	グループ：
	<dd class="filter">
		<input id="class-filter-0" name="class-filter" type="radio" value="" checked/><label for="class-filter-0">全て</label>
		<!-- <input id="class-filter-1" name="class-filter" type="radio" value="admin"/><label for="class-filter-1">admin</label> -->
		<input id="class-filter-2" name="class-filter" type="radio" value="管理者"/><label for="class-filter-2">管理者</label>
		<input id="class-filter-3" name="class-filter" type="radio" value="運営"/><label for="class-filter-3">運営</label>
	</dd>
	<div class="none">
		<dt>Category：</dt>
		<dd>
			<input id="category-filter"/>
		</dd>
		<dt>Qty：</dt>
		<dd>
			<select id="qty-filter"><option></option></select>
		</dd>
	</div>
</dl>

<table>
<thead>
	<tr>
		<th>ID</th>
		<th>ユーザ名</th>
		<th class="group">グループ</th>
		<th></th>
	</tr>
</thead>
<tbody>
<?php 
	foreach ($data as $record){
		echo '<tr>';
		echo "<td>". $record['User']['id']. "</td>";
		echo "<td>". $this->HTML->link($record['User']['username'], array('action' => 'change_user', '?' => array('user_id' => $record['User']['id']))). "</td>";
		echo "<td>". $record['Group']['name']. "</td>";
		echo "<td>". $this->Form->postLink('削除', array('action'=>'delete_user', $record['User']['id']), array('confirm'=>'削除していいですか？')) ."</td>";
		echo '</tr>';
	}
?>
</tbody>
</table>

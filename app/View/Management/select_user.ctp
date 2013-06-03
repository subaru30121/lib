<h1>ユーザ一覧</h1>

<table>
<tr>
	<th>ID</th>
	<th>ユーザ名</th>
	<th>グループ</th>
	<th></th>
</tr>
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
</table>
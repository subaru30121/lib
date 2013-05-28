<h1>ユーザ一覧</h1>

<table>
<tr>
	<th>ID</th>
	<th>ユーザ名</th>
	<th>グループ</th>
</tr>
<?php 
	foreach ($data as $record){
		echo '<tr>';
		echo "<td>". $record['User']['id']. "</td>";
		echo "<td>". $record['User']['username']. "</td>";
		echo "<td>". $record['Group']['name']. "</td>";
		echo '</tr>';
	}
?>
</table>
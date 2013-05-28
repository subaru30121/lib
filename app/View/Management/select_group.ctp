<h1>ユーザ一覧</h1>

<table>
<tr>
	<th>ID</th>
	<th>グループ名</th>
</tr>
<?php 
	foreach ($data as $record){
		echo '<tr>';
		echo "<td>". $record['Group']['id']. "</td>";
		echo "<td>". $record['Group']['name']. "</td>";
		echo '</tr>';
	}
?>
</table>
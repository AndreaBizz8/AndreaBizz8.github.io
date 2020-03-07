<?php
include('database.php');

//collect the passed id
$id = $_GET['show_ID'];

//run a query 
$stmt = $conn->query('SELECT show_info.show_title, show_info.show_ID, production_info.production_ID, production_info.production_name
FROM show_info, production_info
WHERE show_info.show_ID = '.$conn->quote($id).'
GROUP BY production_info.production_ID');

//loop through all returned rows
while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    echo "<tr>
			<td class='col-auto'>$row->show_title </th>
			<td class='col-auto'>$row->show_ID </th>
			<td class='col-auto'>$row->production_ID </th>
			<td class='col-auto'>$row->production_name </th>
		</tr>";
}
?>
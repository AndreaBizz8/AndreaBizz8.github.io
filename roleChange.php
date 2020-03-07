<?php
include('database.php');

//collect the passed id
$id = $_GET['show_ID'];

//run a query 
$stmt = $conn->query('SELECT role.role_ID, role.show_ID, role_type.role_type_name, role.role_name
FROM role, role_type
WHERE role.show_ID = '.$conn->quote($id).'
GROUP BY role.role_ID');

//loop through all returned rows
while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    echo "<tr>
			<th class='col-auto'>$row->show_ID </th>
			<th class='col-auto'>$row->role_name </th>
			<th class='col-auto'>$row->role_type_name </th>
			<th class='col-auto'>19:30</th>
		</tr>";
}
?>
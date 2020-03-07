<?php
include('database.php');

//collect the passed id
$id = $_GET['continent_ID'];
$id1 = $_GET['country_ID'];
$id2 = $_GET['state_ID'];

//run a query 
$stmt = $conn->query('SELECT * FROM country WHERE continent_ID = '.$conn->quote($id).' ORDER BY country_name ');

//loop through all returned rows
while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    echo "<option value='$row->country_ID'>$row->country_name</option>";
}

//run a query 
$stmt1 = $conn->query('SELECT * FROM state WHERE country_ID = '.$conn->quote($id1).' ORDER BY state_name ');

//loop through all returned rows
while($row = $stmt1->fetch(PDO::FETCH_OBJ)) {
    echo "<option value='$row->state_ID'>$row->state_name</option>";
}

//run a query 
$stmt1 = $conn->query('SELECT * FROM region WHERE state_ID = '.$conn->quote($id2).' ORDER BY region_name ');

//loop through all returned rows
while($row = $stmt1->fetch(PDO::FETCH_OBJ)) {
    echo "<option value='$row->region_ID'>$row->region_name</option>";
}
?>
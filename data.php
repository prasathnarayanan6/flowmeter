<?php 
require "conn.php";
header('Content-Type: application/json');
$sql = "SELECT * FROM flowmeter ORDER BY id DESC LIMIT 1";
$query=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($query);
$sensors = [
    'id' => $row['id'],
    'flow' => $row['flow'],
    'time' => $row['time']
];
echo json_encode($sensors);


?>  
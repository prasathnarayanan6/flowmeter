<?php 
require "conn.php";
$sql1 = "SELECT * FROM fixed ORDER BY id DESC LIMIT 1";
$query1=mysqli_query($conn, $sql1);
$row1=mysqli_fetch_array($query1);
$fix = [
    'id' => $row1['id'],
    'time' => $row1['time'],
    'val' => $row1['val']
];

echo json_encode($fix);

?>
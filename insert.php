<?php 
require "conn.php";
$date = date("Y-m-d_h:i:s");
$id = $_GET['id'];
$flow = $_GET['flow'];
$sql = "INSERT INTO flowmeter(id, flow, time) VALUES('$id', '$flow', '$date')";

$sql1 = "SELECT * from control ORDER BY time DESC";
$result = mysqli_query($conn, $sql1);
$num = mysqli_fetch_array($result);
if ($conn->query($sql) === TRUE) {
    //echo "STATUS: OK";
    echo $num['fix'];

}
else{   
    echo "<h6>STATUS: failed</h6>";
}
?>
<?php 
require "conn.php";
$date = date("Y-m-d_h:i:s");
$id = $_GET['id'];
$flow = $_GET['flow'];
$state = $_GET['state'];
$sql = "INSERT INTO flowmeter(id, flow, time, state) VALUES('$id', '$flow', '$date' , '$state')";

$sql1 = "SELECT * from fixed ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql1);
$num = mysqli_fetch_array($result);
if ($conn->query($sql) === TRUE) {
    //echo "STATUS: OK";
    echo $num['val'];

}
else{   
    echo "<h6>STATUS: failed</h6>";
}
?>
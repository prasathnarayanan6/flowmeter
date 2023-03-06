<?php 
include_once "conn.php";
session_start();
if(!isset($_SESSION['email']) && !isset($_SESSION['identity'])){
    header('location: login.php');
	  die();
}
$sql1 = "SELECT * FROM fixed ORDER BY id DESC LIMIT 1";
$query1=mysqli_query($conn, $sql1);
$row1=mysqli_fetch_array($query1);
$fix = $row1['val'];


//second table
$sql = "SELECT * FROM flowmeter ORDER BY id DESC LIMIT 1";
$query=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($query);
$flow = $row['flow'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/mm.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <style>
      .zoom {
  /* padding: 50px; */
  transition: transform .2s; /* Animation */
  /* width: 200px;
  height: 200px; */
  /* margin: 0 auto; */
}

.zoom:hover {
  transform: scale(1.1);
  background-color: #152238 ;
  color: white;
 /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}

        @font-face {
            font-family: 'myFirstFont';
        }
        body {
            background-color: #F5F7FA;
            font-family: 'myFirstFont';
        }
        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

/* Sidebar */
.sidebar {
position: fixed;
top: 0;
bottom: 0;
left: 0;
padding: 58px 0 0; /* Height of navbar */
box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
width: 240px;
z-index: 600;
}

@media (max-width: 991.98px) {
.sidebar {
width: 100%;
}
}
.sidebar .active {
border-radius: 5px;
box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
position: relative;
top: 0;
height: calc(100vh - 48px);
padding-top: 0.5rem;
overflow-x: hidden;
overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}
@media (max-width: 1174px) {
    .fnee{
        display: flex;
        justify-content: center;
    }
  /* CSS that should be displayed if width is equal to or less than 800px goes here */
}
    </style>

</head>
<body>
    <!--Main Navigation-->
<header>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <center><img src="./img/Xyma_BG.svg" width="70%"></img></center>
    <div class="position-sticky bg-white">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="#" class="list-group-item list-group-item-action zoom">
          <i class="fas fa-tachometer-alt fa-fw me-3 mt-3"></i><span>Dashboard</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action zoom"><i
            class=" fas fa-search-plus fa-fw me-3 mt-3"></i><span>Analytics</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action zoom">
          <i class="fas fa-chart-line fa-fw me-3 mt-3"></i><span>Graph</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action zoom"><i
            class="fas fa-cog fa-spin fa-fw me-3 mt-3"></i><span>Settings</span>
        </a>
      </div>
    </div>
    <center><p class="mt-5">©️ All rights Reserved</p></center>
    <center><img src="./img/Xyma_BG.svg" width="55%" class="mt-4"></img></center>
  </nav>
  <!-- Sidebar -->

</header>
<!--Main Navigation-->

<!--Main layout-->
<main style="">
  <div class="container-fluid pt-2">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Dashboard</a>
                            <div class="d-flex ms-auto">
                                <?php 
                                    echo $_SESSION['email'] ;
                                ?>
                            </div>
                    </div>
            </nav><br>
            <?php
                    // $sql = "SELECT * FROM fixed ORDER BY id DESC LIMIT 1;";
                    // $result = mysqli_query($conn, $sql);      
                    // $num = mysqli_fetch_array($result); 
            ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                    <!--box 1-->
                    <div class="col-xl-3 col-sm-6 col-12 mt-1">
                        <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                        <h3 class="danger" id="s2">-</h3>
                                        <span style="color:#152238">Fixed</span>
                                </div>
                                <div class="ms-auto h1 pt-2">
                                    <i class="fa-solid fa-water" style="color:#152238"></i>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>                  

                    <!--box 2-->
                    <div class="col-xl-3 col-sm-6 col-12 mt-1">
                        <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                        <h3 class="danger" id="s1">-</h3>
                                        <span style="color:#152238">Flow Count</span>
                                </div>
                                <div class="ms-auto h1 pt-2">
                                    <i class="fa-solid fa-water" style="color:#152238"></i>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!--box 2-->
                    <div class="col-xl-3 col-sm-6 col-12 mt-1">
                        <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                        <h3 class="" id="blinkk">Open
                                        </h3>
                                        <span class="">Valve status</span>
                                </div>
                                <div class="ms-auto h1 pt-2">
                                     <i class="fa-solid fa-lock text-success"></i>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-sm-6 col-12 mt-1">
                        <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                        <h3 class="text-success" id="blinkk">On
                                        </h3>
                                        <span class="">Switch</span><br>    
                                </div>
                                <div class="ms-auto pt-2">
                                    <!-- <i class='fas fa-toggle-off'></i> -->
                                    <div class="form-check form-switch form-switch-sm" style="">
                                            <input class="form-check-input form-check-input-sm" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    </div><!--inner row close--><br>
                    <div class="row"><!--inner row 2-->
                        <div class="col-md-12 fnee">
                                    <div class="col-xl-12 col-sm-6 col-12 mt-1">
                                        <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                        <h4 class="text-primary badge" id="blinkk">Set Litre Value</h4><br><br>
                                                        <span class="">Total Litre used: 10000</span>
                                                </div>
                                                <div class="ms-auto h1 pt-2">
                                                    <form action="" method="post">
                                                        <div class="form-group">
                                                            <input type="text" name="vall" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Litres Amount">
                                                            <center><button type="submit" name="set" class="btn btn-dark btn-sm">Set</button></center>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                        </div>
                    </div><!--inner row 2-->

                </div><!--col-md-8-->
                <div class="col-md-4"><br>
                        <div class="row"><!---inner row-->
                                <div class="col-xl-12 col-sm-12 col-12 mt-1">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="media d-flex">
                                                        <div class="media-body text-left">
                                                                <h3 class="text-dark" id="blinkk">Mac Address</h3>
                                                                <span class=""><?php echo $_SESSION['ip']; ?></span><br>    
                                                        </div>
                                                        <div class="ms-auto h1 pt-2">
                                                            <i class='fas fa-wifi'></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                        </div><!--inner row close-->

                        <div class="row"><!---inner row-->
                                <div class="col-xl-12 col-sm-12 col-12 mt-2">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="media d-flex">
                                                        <div class="media-body text-left">
                                                                <h3 class="text-dark" id="blinkk">Login Time</h3>
                                                                <span class=""><?php echo $_SESSION['time']; ?></span><br>    
                                                        </div>
                                                        <div class="ms-auto h1 pt-2">
                                                            <i class='far fa-clock'></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                        </div><!--inner row close-->
                </div><!---col-md-4-- close-->
            </div><!--main row close-->
                        
  </div>   
</main>
<?php
if(isset($_POST['set'])){
    $vall = $_POST['vall']; 
    $time = $_SESSION['time'];
    $ins = "INSERT INTO fixed(id, time, val) VALUES('1', '$time', '$vall')";
    // $conn->query($ins);
    if(empty($vall)){
        echo "<script>
         Swal.fire(
            'Amount of Litres?',
            '',
            'question'
          )</script>";
    }
    else{
        if($conn->query($ins) === TRUE){
            echo "<script>
            Swal.fire(
               'Data inserted Successfully',
               '',
               'success'
             )</script>";
        }
        else{
            echo "failed";
        }
        
    }
}
    

?> 
<!--Main layout-->
<script>
         function startLiveUpdate(){
            const textViewCount = document.getElementById('s1');
            setInterval(function() {
               fetch('./data.php?id=1').then(function(response){
                  return response.json();
               }).then(function(sensors){
                  textViewCount.textContent = sensors.flow;
                
                })
            }, 5000);
         }
         
         document.addEventListener('DOMContentLoaded', function (){
            startLiveUpdate();
         });


         function startLiveUpdatee(){
            const textViewCount = document.getElementById('s2');
            setInterval(function() {
               fetch('./fix.php').then(function(response){
                  return response.json();
               }).then(function(fix){
                  textViewCount.textContent = fix.val;
                
                })
            }, 5000);
         }
         
         document.addEventListener('DOMContentLoaded', function (){
            startLiveUpdatee();
         });
</script>
</body>

</html>
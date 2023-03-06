<?php
require "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./static/jquery.min.js"></script>
    <script src="./sweetalert/dist/sweetalert.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/mm.css" rel="stylesheet"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./sweetalert/dist/sweetalert.min.js"></script>
    <link href="./fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body{
        font-family: 'myFirstFont'; 
    }
    input{
      border-top-style: hidden;
      border-right-style: hidden;
      border-left-style: hidden;
      border-bottom-style: groove;
    }
    .no-outline:focus {
     outline: none;
    }
    h4{
      /* Increase this as per requirement */
      padding-bottom: 10px;
      border-bottom-style: solid;
      border-bottom-width: 3.1px;
      width: fit-content;
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
     background-color: white;
    }
    li {
      float: left;
      /* text-align: center; */
    }
    li a {
      display: block;
      color: black;
      text-align: center;
      padding: 16px;
      text-decoration: none;
    }
    </style>    
    <title>Login</title>
</head>
<body><br><br>  
<center><img src="./img/Xyma_BG.svg" width="200px"></img></center><br><br>
<center><h4>Login</h4></center><br> 
<div style="display: flex; justify-content: center; align-items: center; height: 30vh;">
  <form action="" method="post">
    <input type="email" name="email" class="no-outline email" id="exampleFormControlInput1 email" placeholder="Email" size="30"><br><br>
    <input type="password" name="password" class="no-outline password" id="exampleFormControlInput1 password" placeholder="Password" size="30"><br><br><br>
    <center><input type="submit" name="login" class="btn btn-dark"></center>
  </form>
</div><br><br>
<center> 
<p><b>© 2021 XYMA Analytics Inc. IIT Madras Research Park, Chennai, 600113</b></p>
</center>   
</body>
</html>
<?php
if(isset($_POST['login'])){
    $email = $_POST['email'] ; 
    $password = $_POST['password'];

    $pass = 'vedanta256';
    $method = 'aes-256-cbc';
    $key = substr(hash('sha256', $password, true), 0, 32);
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    $encrypted = base64_encode(openssl_encrypt($password, $method, $key, OPENSSL_RAW_DATA, $iv));
    $decrypted = openssl_decrypt(base64_decode($encrypted), $method, $key, OPENSSL_RAW_DATA, $iv);

        
// //session
// $_SESSION['email'] = $email;
// $_SESSION['password'] = $password;
    
    //generate random
    //random key generate
    function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

 
    $sanitized_userid = mysqli_real_escape_string($conn, $email);
    $sanitized_password = mysqli_real_escape_string($conn, $encrypted);
 
    
    $sql = "SELECT * FROM login WHERE email = '" . $sanitized_userid . "' AND pass = '" . $sanitized_password . "'";
    $result = mysqli_query($conn, $sql) 
         or die(mysqli_error($conn));
      
     $num = mysqli_fetch_array($result);

     date_default_timezone_set('Asia/Kolkata');
         $date = date("Y-m-d_h:i:sa");

         ob_start();
         system('ipconfig/all');
         $mycom=ob_get_contents(); 
         ob_clean(); 
         $findme = "Physical";
         $pmac = strpos($mycom, $findme); 
         $mac=substr($mycom,($pmac+36),17);

         //generate hash infooo

          // Store Mac Address
 
        $randomval1 = generateRandomString();//Database Comp
        $randomval2 = generateRandomString();//Cookies Comp
        $identityid =   generateRandomString();//Cookies Comp
     if($num > 0) {
        
         
         
            //  $_SESSION['hashkey1'] = $randomval1; 
            //  $_SESSION['hashkey2'] = $randomval2; 
            setcookie("key",$randomval2, time()+15000, "/", "", 0);

            $randomval2 = md5($randomval2); 

            session_start();
            $_SESSION['email']=$sanitized_userid;
            $_SESSION['identity'] = $identityid;
            $_SESSION['ip'] = $mac;
            $_SESSION['time'] = $date;
            
     
            

            header("Location: dashboard.php?identity={$identityid}&&macaddress={$mac}");

         $ins = "INSERT INTO loginact(email, datetime, mac,identity,hashkey) VALUES('$email','$date', '$mac', '$identityid','$randomval1')";
         $conn->query($ins);
       }
       else {
        if(empty($email) || empty($password)){
            echo "<script>
            Swal.fire({
            icon: 'question',
           title: 'Credentials?..😒',
           text: 'Please Enter Email and password',
         })
         </script>"; 
        }
        else{
         echo "<script>
            Swal.fire({
            icon: 'error',
           title: 'Oops...😞',
           text: 'Wrong Credentials',
         })
         </script>";
         }
     }
    //store login information
    // Getting Mac Address    
     
     
 
    
 }
?>
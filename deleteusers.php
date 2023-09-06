<?php
include('conn.php');

session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
} 

$username = $_SESSION['user_id'];

$userid = isset($_GET['rowid']) ? $_GET['rowid'] : '';
//$userid = $_GET['rowid'];

$user_type = isset($_GET['typeid']) ? $_GET['typeid'] : '';
//$user_type = $_GET['typeid'];

$deleteuser = "SELECT * FROM userdetails WHERE usertype_id = '$user_type' AND id = '$userid'";

$resultdelete = $conn->query($deleteuser);
if(!$resultdelete){
    echo $conn->error;
    echo $deleteuser;	
}

$usernam = "";
$user_id = "";
$usertype = "";

while($row=$resultdelete->fetch_assoc()){
    $usernam = $row['username'];
    $user_id = $row['id'];
    $usertype = $row['usertype_id'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GET FIT NOW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
    <link rel="stylesheet" href="gui.css">

    <style>
    .deletebutton {
        display: block;
        text-align: -webkit-center;
        background: none;
        border: none;
    }

    </style>

</head>

<body class="altwallpaper">
    <div id="container">
        <!--Start of Hamburger Menu-->
        <div class="hamburgermenu">
        <label for="demo-toggle" class="button drawer-toggle persistent doc"></label>
            <input type="checkbox" id="demo-toggle" class="drawer persistent">
            <div class="demo doc">
            <h3>Menu</h3>
            <label for="doc-drawer-checkbox" class="button drawer-close"></label>
            <label for="demo-toggle" class="button drawer-close"></label>
                <a id="present" href="index.php" class="myNavSideButton">Home</a>
                <a href="login.php" class="myNavSideButton">Login</a>
                <a href="useraccount.php" class="myNavSideButton">My Account</a>
                <a href="edituseraccount.php" class="myNavSideButton">Edit My Account</a>
                <a href="logout.php" class="myNavSideButton">Logout</a>
                <a href="whatwedo.php" class="myNavSideButton">What We Do</a>
                <a href="trainer.php" class="myNavSideButton">Your Trainer</a>
                <a href="contactus.php" class="myNavSideButton">Contact Us</a>
                <a href="signup.php" class="myNavSideButton">Sign Up Now!</a>
            </div>
        </div>
        <!--End of Hamburger Menu-->

        <!--start of maincontent-->
        <div id="maincontent">
            <div id="blogtext">
                <?php 
                $userna = "SELECT * FROM userdetails WHERE id = '$userid'";

                $resultname = $conn->query($userna);
    
                if(!$resultname) {
                    echo $conn->error;
                }
    
                            while($rowname=$resultname->fetch_assoc()){
                                $u_name = $rowname['username'];
                            }
                
                
                echo "<h1><b>Delete $u_name?</b></h1>
                    <div>If yes, click Delete Account</p></div>
                
                <div>
                    <form action='deleteusers.php?typeid=$usertype&rowid=$userid' method='POST' name = 'deleteuser' class='deletebutton' enctype='multipart/form-data' display='grid'>
                    <input value='$user_id' type='hidden' name='users_id'>
                    <input value='$usertype' type='hidden' name='userstype_id'>
                    <input type='submit' class='myButton' name='delete_user' value='Delete Account'/> 
                    <form>
                    </div>
                    ";
                        ?>   
                     
                        <?php
                                    if(isset($_POST['delete_user'])){

                                        $usermainid = $conn -> real_escape_string($_POST['users_id']);
                                        $usertypemainid = $conn -> real_escape_string($_POST['userstype_id']);
                                        
                                        $deleteuseraccount = "DELETE FROM userdetails WHERE id = '$usermainid' AND usertype_id = '$usertypemainid'";

                                        $resultdeleteuser = $conn->query($deleteuseraccount);
                                            
                                            if ($resultdeleteuser) {
                                                echo "<h1><b>Client Deleted!</b></h1>";
                                            } else {
                                                echo $conn->error;
                                                echo $deleteuseraccount;
                                            }
                                    }
                                        
                                ?>

                            
                            <a href="index.php" class="myButton">Return to Home</a>
                            <a href="viewusers.php" class="myButton">Return to View Clients</a>
                            
                    </div>
            </div>

    </div>
</body>



</html>
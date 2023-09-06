<?php
include('conn.php');
session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
}

$userid = isset($_GET['rowid']) ? $_GET['rowid'] : '';
$usermes_id = isset($_GET['userid']) ? $_GET['userid'] : '';


$usermsg = "SELECT * FROM admin_inbox WHERE id = '$userid' AND usermessage_id = '$usermes_id'";

$result = $conn->query($usermsg);

if(!$result) {
    echo $conn->error;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>40022221 Web Project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
    <link rel="stylesheet" href="gui.css">

    <style>

        form {
            background: none;
            border: none;
        }

        .card{
            display: inline-block;
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

            $userna ="SELECT admin_inbox.id, admin_inbox.usermessage_id, admin_inbox.usermessage, admin_inbox.messagesent, userdetails.username 
            FROM `admin_inbox` INNER JOIN userdetails ON admin_inbox.usermessage_id = userdetails.id WHERE admin_inbox.id = '$userid'";

            $resultname = $conn->query($userna);

            if(!$resultname) {
                echo $conn->error;
            }
                        $u_name = "";
                        while($rowname=$resultname->fetch_assoc()){
                            $u_name = $rowname['username'];
                            $messageuser_id = $rowname['usermessage_id'];
                            
                        
                        echo "
                        <h1><b> Contact $u_name </b></h1>
                        <div class='column accountmenu'>
                        <a href='viewusers.php' class='myButton'>Return to View Clients</a>
                        <a href='admininbox.php' class='myButton'>Return to Inbox</a>
                        </div> "; 
                        }
            ?>
            
            <?php

        while($row2=$result->fetch_assoc()){
            $uid = $row2['id'];
            $umsg = $row2['usermessage'];
            $umsg_id = $row2['usermessage_id'];

            echo "<form action='contactusers.php?rowid=$uid&uid=$umsg_id' method='POST' enctype='multipart/form-data'>
                    
                        <div class='col-sm-8 card'>
                            <div class='section'>
                                <h3 class='doc'>$u_name's Message</h3>
                                <p class='doc'>$umsg</p>
                             <input value='<?php echo $umsg_id ?>' type='hidden' name='umessid'>
                            </div>
                        </div>

                        <div class='col-sm-4 card'>
                            <div class='section'>
                                <h3 class='doc'>Your Reply</h3>
                                <textarea id=' msg' name='adminmessa' placeholder='Enter Message' style='width:85%;' class='doc' type='text'></textarea>
                            </div>
                        </div>

                    <input type='submit' value='Submit' name='submitadminmessage'>
                    </form> ";
            }
                        
                                            if(isset($_POST['submitadminmessage'])){

                                                $messagedata = $conn -> real_escape_string($_POST['adminmessa']);
                                                $userm_id = $conn -> real_escape_string($_POST['umessid']);
                                                
                                                $adminmsg = "INSERT INTO `user_inbox` (`id`, `usermessage_id`, `adminmessage`, `datesent`) 
                                                                               VALUES (NULL, '$messageuser_id', '$messagedata', NOW())";  

                                                $result = $conn -> query($adminmsg);

                                                if(!$result){
                                                    echo $conn -> error;
                                                    echo $adminmsg;
                                                } else {
                                                    //echo $adminmsg;
                                                   // echo $conn -> error;
                                                echo "<h1><b> Message sent!</b></h1>";
                                                }

                                            
                                            } 

                                    ?> 
                                    
                                </div>         
        </div>

    </div>

    
</body>

            

</html>
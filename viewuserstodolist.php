<?php
include('conn.php');
session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
}

//$username = $_SESSION['user_id'];

$userid = $_GET['rowid'];
//$user_type = $_GET['typeid'];
//$user_type = isset($_GET['typeid']) ? $_GET['rowid'] : '';

$userchecklist = "SELECT * FROM userchecklist WHERE userlist_id = '$userid'";

$result = $conn->query($userchecklist);

if(!$result) {
    echo $conn->error;
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
        .row2{
            justify-content: center;
            padding: 10px;
            width: 50%;
            margin: auto;
        }
    </style>

</head>

<body class="altwallpaper">
    <div id="container">
        <!--Start of Hamburger Menu-->
        <div class="hamburgermenu">
        <label for="demo-toggle" class="button drawer-toggle persistent doc"><br><b>Menu</b></label>
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
            <div id="textbackground">

            </div>
            <div id="blogtext">
            
            <?php 

            $userna = "SELECT * FROM userdetails WHERE id = '$userid'";

            $resultname = $conn->query($userna);

            if(!$resultname) {
                echo $conn->error;
            }

                        while($rowname=$resultname->fetch_assoc()){
                            $u_name = $rowname['username'];
                        
                        echo "
                        <h1><b> $u_name's To Do List </b></h1>
                        <div class='column accountmenu'>
                        <a href='viewusersdetails.php' class='myButton'>View $u_name Details</a>
                        <a href='editusers.php' class='myButton'>Edit $u_name Details</a>
                        <a href='viewusercalendar.php' class='myButton'>View $u_name's Calendar</a>
                        <a href='viewuserstodolist.php' class='myButton'>View $u_name's To Do List</a>
                        <a href='deleteusers.php' class='myButton'>Delete $u_name's Account</a>
                        </div> "; 
                        }
            ?>
            


                <!--I tried to attempt using javascript for using a checkbox for the to do list but I just couldn't figure it out-!-->

            
                        <?php
                            while($row=$result->fetch_assoc()){

                                $task_name = $row['task'];
                                $todoid = $row['id'];
                                $username = $row['userlist_id'];
                                
                                    echo "

                                    <div class='row2'>
                                            <div class='card'>
                                                <div class='section'>
                                                    <p class='doc'><b>Task:</b> $task_name <a href='updatetodo.php?rowid=$todoid' class='myButton'>edit</a></p>
                                                    <p>
                                                    <b>Task Complete?</b>
                                                    <button type='button' class='check myButton'>Yes</button>
                                                    <button type='button' class='uncheck myButton'>No</button>
                                                    <input type='checkbox' id='myCheck'> </p>
                                                         
                                                </div>
                                            </div>
                                        </div>


                                    ";
                                    
                            }

                        ?>
                
            </div>
                

            </div>
        </div>

    </div>
</body>

<!--https://www.tutorialrepublic.com/codelab.php?topic=faq&file=jquery-check-or-uncheck-checkbox-->

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script>
$(document).ready(function(){
    $(".check").click(function(){
        $("#myCheck").prop("checked", true);
        localStorage.setItem("checked", "true");

    });
    $(".uncheck").click(function(){
        $("#myCheck").prop("checked", false);
        localStorage.setItem("checked", "false");
    });
});
</script>


</html>
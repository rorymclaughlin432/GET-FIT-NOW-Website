<?php
include('conn.php');

session_start();

if(!isset($_SESSION['user_id'])){
	header("location: login.php");
}

$username = $_SESSION['user_id'];

$userid = isset($_GET['rowid']) ? $_GET['rowid'] : '';
//$taskname = isset($_GET['rowid']) ? $_GET['rowid'] : '';

$userchecklist = "SELECT * FROM userchecklist WHERE id = '$userid' AND userlist_id = '$username'";

                $result = $conn->query($userchecklist);

                if(!$result){
                    echo $conn->error;
                }

                $todoid = "";
                $usernameid = "";

                while($row=$result->fetch_assoc()){
                    $todoid = $row['id'];
                    $usernameid = $row['userlist_id'];
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
    .deletebutton {
        display: inline-block;
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
                <a href="index.php" class="myButton">Return to Home</a>
                <a href="useraccount.php" class="myButton">Return to Account</a>
                <a href="usertodolist.php" class="myButton">Return to To Do List</a>
                
                <?php 

                $tasknam = "SELECT * FROM userchecklist WHERE id = '$userid'";

                $resultname = $conn->query($tasknam);

                if(!$resultname){
                    echo $conn->error;
                }

                $task_name = "";
                while($rowname=$resultname->fetch_assoc()){
                    $task_name = $rowname['task'];
                } 

                echo "<h1><b>Delete $task_name?</b></h1>
                
                <p> If yes, click Delete Task</p>
                
                <div>
                    <form action='deletetask.php?rowid=$username&todoid=$userid' method='POST' name = 'deletetask' class='deletebutton' enctype='multipart/form-data' display='grid'>
                    <input value='$todoid' type='hidden' name='todo_id'>
                    <input value='$usernameid' type='hidden' name='unamid'>
                    <div><input type='submit' class='myNavSideButton' name='delete_task' value='Delete Task'/></div>
                    <form>
                    </div>
                    ";
                
                        ?>   
                     
                        <?php
                                    if(isset($_POST['delete_task'])){

                                        $usertaskid = $conn -> real_escape_string($_POST['todo_id']);
                                        $useridtask = $conn -> real_escape_string($_POST['unamid']);
                                        
                                        $deleteusertask = "DELETE FROM userchecklist WHERE id = '$usertaskid' AND userlist_id = '$useridtask'";

                                        $resultdeletetask = $conn->query($deleteusertask);
                                            
                                            if ($resultdeletetask) {
                                                echo "<h1><b>Task Deleted!</b></h1>";
                                            } else {
                                                echo $conn->error;
                                                echo $deleteusertask;
                                            }
                                    }
                                        
                                ?>
                            
                    </div>
            </div>

    </div>
</body>



</html>
<?php
include('conn.php');

session_start();

if(!isset($_SESSION['user_id'])) {
    
    header("location: login.php");
}

$username = $_SESSION['user_id'];

$userevents = "SELECT * FROM userchecklist WHERE userlist_id = '$username'";

//$userevent = "SELECT userdetails.username, usercalendar.user_date, usercalendar.events FROM usercalendar INNER JOIN userdetails ON usercalendar.user_id = userdetails.id WHERE userdetails.id = $username"; 

$result = $conn->query($userevents);

	if(!$result){
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
            <div id="textbackground">

            </div>
            <div id="blogtext">

                <h1>Add Tasks to To Do List</h1>
                <a href='useraccount.php' class='myButton'>Your Account</a>
                <a href='usertodolist.php' class='myButton'>To Do List</a>
            
            <form action="addtodolist.php" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="doc">Add Task</legend>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md"><input type="text" placeholder="Enter task..." name="addtodo" id="event" style="width:85%;" class="doc" required=""></div>
                        </div>
                        <input type="submit" value="Submit">
                    </fieldset>
                </form>
            </div>
                                    <?php
                                                if(isset($_POST['addtodo'])){

                                                    $usertodo = $conn -> real_escape_string($_POST['addtodo']);
                                                    $userid = $conn -> real_escape_string($_SESSION['user_id']);
                                                    
                                                    $addtodo = "INSERT INTO `userchecklist` (`userlist_id`, `task`) VALUES ('$userid', '$usertodo')"; 

                                                    $result = $conn -> query($addtodo);

                                                    if(!$result){
                                                        echo $conn -> error;
                                                    } else {
                                                    
                                                    echo "<h1><b>Item added to To Do List</b></h1>";
                                                    }
                                                }

                                    ?>          
        </div>

    </div>

    
</body>



</html>
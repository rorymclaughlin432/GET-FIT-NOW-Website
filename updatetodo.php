<?php
include('conn.php');

session_start();

if(!isset($_SESSION['user_id'])){
    
    header("location: login.php");
} 

$username = $_SESSION['user_id'];

$todoid = $_GET['rowid'];

$todo = "SELECT * FROM userchecklist WHERE id = '$todoid' AND userlist_id = '$username'";

$result = $conn->query($todo);
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
            <h2> Edit Your To Do List </h2>
            <a href="usertodolist.php" class="myButton">Return to To Do List</a>
            
            <form action='updatetodo.php?rowid=$todo_id' method='POST' enctype="multipart/form-data" display="grid" id="userform">
                     
                     <?php
                            $task_id = "";
                            $task_name = "";
                            while($row = $result->fetch_assoc()){

                                $usernid = $row['userlist_id'];
                                $task_id = $row['id'];
                                $task_name = $row['task'];
                            }

                     ?>

                     <label><b>Task:</b></label> 
                     <input type="text" name="usertask" value="<?php echo $task_name ?>"/>
                     <input value='<?php echo $task_id ?>' type='hidden' name='taskid'>
                     <input type="submit" name="update_task" value="Update Task"/>
                    <?php
                        if(isset($_POST['update_task'])){

                            $usert = $conn -> real_escape_string($_POST['usertask']);
                            $usertask_id = $conn -> real_escape_string($_POST['taskid']);
 
                            $updatelist = "UPDATE userchecklist SET task = '$usert' WHERE id = '$usertask_id' AND userlist_id = '$username'";
                            $resultlist = $conn->query($updatelist);

                                if (!$resultlist) {
                                    echo $conn->error;
                                } else {
                                    echo "<p><b>Your Task has been updated!</b></p>";
                                    echo $updatelist;
                                }
                        }
                            
                    ?>
                </form>

            </div>
        </div>

    </div>
</body>



</html>
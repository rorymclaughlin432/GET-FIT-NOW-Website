<?php
include('conn.php');

session_start();

if(!isset($_SESSION['user_id'])){
	header("location: login.php");
} 

$username = $_SESSION['user_id'];

$useraccount = "SELECT * FROM userdetails WHERE id = '$username'";

$result = $conn->query($useraccount);
if(!$result){
    echo $conn->error;	
} 

while($row=$result->fetch_assoc()){

    $userimg = $row['userpic'];
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
            <h2> <b>Edit Your Profile Pic</b></h2>
            <div class='column accountmenu'>
                <a href='index.php' class='myButton'>Return to Home</a> 
                <a href='useraccount.php' class='myButton'>Return To Your Account</a>
                        </div>
            
                <form action='changeprofilepic.php' method='POST' enctype="multipart/form-data" display="grid" id="userform">
                     
                     <label for="imageup"><b>Image:</b></label><br>          
                     <input type="file" name="image" 
            
                        value="<?php 

                        $imgname = $_FILES["file"]["name"]; 
                        $img="img/".$imgname;
                        
                        echo "<img src='/img/".$imgname." />'";
                        
                        ?>" /><br><br>  

			         <input type="submit" name="update_profile_pic" value="Update Profile" /> 
                </form>
                    <?php
                        if(isset($_POST['update_profile_pic'])){

                            $img =  $_FILES["image"]["name"];
                            $imgtemp = $_FILES["image"]["tmp_name"];
                            $move = move_uploaded_file($imgtemp, "img/$img");
                            
                            if(!$move){
                            echo "Not uploaded because of error ".$_FILES["image"]["error"];
                            }
                            
                            $updatepic = $conn->query("UPDATE userdetails 
                            
                            SET
                            userpic = '$img' 
                            WHERE id = '$username'");

                            if ($updatepic) {
                                echo "<h1><b>Your profile pic has been updated!</b></h1>";
                            } else {
                                echo $conn->error;
                            }
                                
                                
                        }

                        
                            
                    ?>
                

            </div>
        </div>

    </div>
</body>



</html>
<?php
include('conn.php');

session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
} 

$username = $_SESSION['user_id'];

$userid = $_GET['rowid'];
$user_type = $_GET['typeid'];

$useraccount = "SELECT * FROM userdetails WHERE usertype_id = '$user_type' AND id = '$userid'";

$result = $conn->query($useraccount);
if(!$result){
    echo $conn->error;	
} 

$usern = "";
$pass = "";
$title = "";
$firstn = "";
$lastn = "";
$phonenumber = "";
$gender = "";
$age = "";
$email = "";
$address = "";

while($row=$result->fetch_assoc()){

    $user_id = $row['id'];
    $usern = $row['username'];
    $usertype = $row['usertype_id'];
    $pass = $row['passw'];
    $title = $row['title'];
    $firstn = $row['firstname']; 
    $lastn = $row['lastname']; 
    $email = $row['email'];
    $phonenumber = $row['phonenumber'];
    $gender = $row['gender'];
    $age = $row['age'];
    $address = $row['user_address'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GET FIT NOW</title>
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
            <h2> Edit Your Profile </h2>
            <h1><?php echo "$usern" ?>'s Profile Settings</h1>

            <?php
                        if(isset($_POST['update_profile'])){

                            $usernam = $conn -> real_escape_string($_POST['usernam']);
                            $pword = $conn -> real_escape_string($_POST['pw']);
                            $tit = $conn -> real_escape_string($_POST['tit']);
                            $firstname = $conn -> real_escape_string($_POST['firstnam']);
                            $lastname = $conn -> real_escape_string($_POST['lastnam']);
                            $useremail = $conn -> real_escape_string($_POST['ema']);
                            $phonenum = $conn -> real_escape_string($_POST['phone']);
                            $gend = $conn -> real_escape_string($_POST['gende']);
                            $userage = $conn -> real_escape_string($_POST['ageuser']);
                            $useraddress = $conn -> real_escape_string($_POST['addre']);
                            $usermainid = $conn -> real_escape_string($_POST['users_id']);
                            $usertypemainid = $conn -> real_escape_string($_POST['userstype_id']);
                            

                            $updateaccount = "UPDATE userdetails 
                            
                            SET 
                            username = '$usernam', 
                            passw = '$pword', 
                            title = '$tit', 
                            firstname= '$firstname', 
                            lastname = '$lastname', 
                            email = '$useremail', 
                            phonenumber = '$phonenum', 
                            gender = '$gend', 
                            age = '$userage', 
                            user_address = '$useraddress' 

                            WHERE id = '$usermainid' AND usertype_id = '$usertypemainid'";

                            $resultedituser = $conn->query($updateaccount);
                                
                                if ($resultedituser) {
                                    echo "<h1><b>Account updated!</b></h1>";
                                    //header('location: useraccount.php?id = $username');
                                } else {
                                    echo $conn->error;
                                    
                                }
                        }
                            
                    ?>
            
                <form action='editusers.php?typeid=$user_type&rowid=$userid' name ="edituser" method='POST' enctype="multipart/form-data" display="grid" id="userform">
                     
                    <input value='<?php echo $userid ?>' type='hidden' name='users_id'>
                    <input value='<?php  echo $user_type ?>' type='hidden' name='userstype_id'>
                     <label><b>User Name:</b></b></label>
                     <input type="text" name="usernam" value="<?php  echo $usern ?>" />
                     <label><b>Password:</b></label>          
			         <input type="password" name="pw" value="<?php  echo $pass ?>" />
                     <label><b>Title:</b></label>
                     <select type="text" name="tit" class="doc" value="<?php echo $title ?>"
                     <option class="doc"></option>
                     <option class="doc">Mr.</option>
                     <option class="doc">Mrs.</option>
                     <option class="doc">Miss.</option>
                     </select>  
                     <label><b>First Name:</b></label>
                     <input type="text" name="firstnam" value="<?php echo $firstn ?>" />
                     <label><b>Last Name:</b></label>
			         <input type="text" name="lastnam" value="<?php echo $lastn ?>" /> 
			         <label><b>Phone Number:</b></label>
			         <input type="number" name="phone" value="<?php echo $phonenumber ?>" />
			         <label><b>Gender:</b></label>
			         <input type="text" name="gende" value="<?php echo $gender ?>" />
                     <label><b>Age:</b></label>
			         <input type="number" name="ageuser" value="<?php echo $age ?>" />
                     <label><b>Email:</b></label>
			         <input type="text" name="ema" value="<?php echo $email ?>" />  
			         <label><b>Address:</b></label> 
			         <input type="text" name="addre" value="<?php echo $address ?>" />      
			         <input onclick="myFunction()" type="submit" name="update_profile" value="Update Profile"/> 
                </form>
            </div>
        </div>

    </div>
</body>

<script>
function myFunction() {
  location.replace("viewusers.php");
}
</script>


</html>
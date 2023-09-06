<?php
include('conn.php');
session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
}

$userid = isset($_GET['rowid']) ? $_GET['rowid'] : '';
$usermes_id = isset($_GET['userid']) ? $_GET['userid'] : '';

//$userinbox = "SELECT * FROM user_inbox WHERE id = '$userid' AND usermessage_id = '$usermes_id' ORDER BY `user_inbox`.`datesent` DESC";
$userinbox = "SELECT user_inbox.id, user_inbox.usermessage_id, user_inbox.adminmessage, user_inbox.datesent, userdetails.username FROM `user_inbox` INNER JOIN userdetails WHERE user_inbox.usermessage_id = userdetails.id ORDER BY `user_inbox`.`datesent` DESC";

$result = $conn->query($userinbox);

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

    <style>
        
        form {
            background: none;
            border: none;
        }

        .card{
            display: inline-block;
        }

        table th {
            text-align:center;
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
                <h1><b>Your Replies</b></h1>
                <div class="column accountmenu">
                <a href='viewusers.php' class='myButton'>Return to View Clients</a>
                <a href='admininbox.php' class='myButton'>Return to Your Inbox</a>
                
                    </div>
                                <?php
                                
                                echo "<table class='doc hoverable'>
                                    <thead class='doc'>
                                        <tr class='doc'>
                                        <th class='doc'>Client</th>
                                        <th class='doc'>Message</th>
                                        <th class='doc'>Date Sent</th>
                                        </tr>
                                    </thead>
                                    <tbody class='doc'>
                                    ";

                            while($row2=$result->fetch_assoc()){
                                $id = $row2['id'];
                                $usernam = $row2['username'];
                                $umsg_id = $row2['usermessage_id'];
                                $umsg = $row2['adminmessage'];
                                $msgdate = $row2['datesent'];
                                $newmsgdate = date('d-m-Y H:i:s', strtotime($msgdate));

                                echo "
                                        <tr class='doc'>
                                        <td data-label='Date Sent' class='doc'>$usernam</td>
                                        <td data-label='Message' class='doc'>$umsg</td>
                                        <td data-label='Date Sent' class='doc'>$newmsgdate</td>
                                        </tr>
                                    

                                
                                
                                ";
                            }

                            echo "</tbody>
                            </table>";
                                            ?>

            </div>
                                                        
        </div>

    </div>

    
</body>

            

</html>
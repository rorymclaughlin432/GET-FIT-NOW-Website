<?php
include('conn.php');
session_start();

if(!isset($_SESSION['user_id'])){
	header("location: login.php");
}

$username = $_SESSION['user_id'];

$userid = isset($_GET['rowid']) ? $_GET['rowid'] : '';

$userchecklist = "SELECT * FROM userchecklist WHERE userlist_id = '$username'";

$result = $conn->query($userchecklist);

if(!$result){
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

    <!--https://www.tutorialrepublic.com/codelab.php?topic=faq&file=jquery-check-or-uncheck-checkbox-->
    <!--http://jsfiddle.net/575VS/18/-->
    <!--https://stackoverflow.com/questions/23298939/how-to-put-check-boxes-next-to-data-displayed-from-the-database-php-sql-->
    
    <style>

        form {
            background:none;
            border: none;
        }

        .row2{
            justify-content: center;
            padding: 10px;
            width: 50%;
            margin: auto;
        }

        .card {
            padding: 0px;
        }

        .column2 {
                float: left;
                width: 25%;
                padding: 10px;
                text-align: center;
        }

        @media screen and (max-width: 600px) {
            .column2 {
            width: 100%;
            display: block;
            margin-bottom: 20px;
            }
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
            <div id="blogtext">
                <h1><b>Your To Do List</b></h1>

                 <div class="column accountmenu">
                        <a href="index.php" class="myButton">Return to Home</a> 
                        <a href="useraccount.php" class="myButton">Return to Account</a>
                        <a href="addtodolist.php" class="myButton">Add Task</a>
                                </div>

                        
                        <?php

                            while($row=$result->fetch_assoc()){

                                //echo " <input type='checkbox' value='".$row['id']."' /> ".$row['Name'];
                                //<a href='#' id='delete'>Yes</a>
                                /*
                                <div class='column2'>
                                            <div class='card'>
                                                <div class='section'>
                                                    <p class='doc'><b>Task:</b> $task_name <a href='updatetodo.php?rowid=$todoid' class='myButton'>edit</a></p>
                                                    <p><b>Task Complete?</b></p>
                                                    <p><button type='button' class='check myButton'>Yes</button>
                                                    <button type='button' class='uncheck myButton'>No</button></p>
                                                    <p><input type='checkbox' id='myCheck'></p>
                                                         
                                                </div>
                                            </div>
                                        </div>

                                        <div class='column2'>
                                            <div class='card'>
                                                    <div class='section'>
                                                        <div>$task_name<input type='checkbox' name='data[]' value='$todoid' /></div>
                                                    
                                                        <p><b>Task Complete?</b> Click <b>Yes</b> to Delete</p>
                                                        
                                                        <p><button type='button' class='delete myButton'>Yes</button></p>
                                                    </div>
                                                </div>
                                        </div>
                                        
                                        <p><b>Task Complete?</b></p> 
                                        <p>Tick the checkbox then click <b>Yes</b> to strike off list</p>
                                        <p><button type='button' class='delete myButton'>Yes</button></p>
                                */

                                $task_name = $row['task'];
                                $todoid = $row['id'];
                                $usernameid = $row['userlist_id'];

                                    echo "

                                        <form id='myForm'>
                                            <div name ='taskname'><b>Task:</b> $task_name</div>
                                            <input value='$todoid' type='hidden' name='todo_id'>
                                            <input value='$usernameid' type='hidden' name='userslistid'>
                                            <div><a href='deletetask.php?rowid=$todoid&userid=$usernameid' class='myButton'>Delete From List</a></div>                                  
                                        </form>
                                        
                                        
                                        
                                    ";
                                    
                            }
                            
                        ?>
                

            </div>
        </div>

    </div>
</body>


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

            <script>
            /*
            $(document).ready(function(){
                $(".check").click(function(){
                    $("#myCheck").prop("checked", true);
                    localStorage.setItem("checked", true);

                });
                $(".uncheck").click(function(){
                    $("#myCheck").prop("checked", false);
                    localStorage.setItem("checked", false);
                });
            });
            
            $(document).ready(function(){
                    $(".delete").click(function(){
                        var id = $(this).val();
                        //$(this).wrap("<strike>");
                        //$("div#"+id).taskname($("myForm").remove());
                        $("div#"+id).remove());
                    });
                });
                
                
                $(".delete").on('click', function () {
                    var data = $("#myForm").serialize();
                    if(data != '') {
                        $.ajax({
                            url: "usertodolist.php",
                            data: data
                        });
                        $("input:checkbox:checked").each(function()
                        {
                            var id = $(this).val();
                            $("div#"+id).wrap("<strike>");
                        });
                    }
                    else
                    {
                        alert("select some checkboxes");
                    }
                });

                */
            </script>



</html>
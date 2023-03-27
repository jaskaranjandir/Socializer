<!DOCTYPE html>
<?php
session_start();
require_once("includes/conn.php");
require_once("functions/functions.php");
if (!isset($_SESSION['username'])) {
    header("location:index.php");
} else {
    $suser = $_SESSION['username'];
    $sq = "select * from users where username='$suser'";
    $sres = mysqli_query($conn, $sq);
    $srow = mysqli_fetch_array($sres);
    $su_id = $srow['user_id'];
    $su_name = $srow['username'];
    $su_image = $srow['user_image'];
}

if (isset($_GET['user_id'])) {
    $fu_id = $_GET['user_id'];
    $gq = "select * from users where user_id='$fu_id'";
    $gres = mysqli_query($conn, $gq);
    $grow = mysqli_fetch_array($gres);
    $gu_id = $grow['user_id'];
    $gu_name = $grow['username'];
    $gu_fullname = $grow['fullname'];
    $gu_image = $grow['user_image'];
}
?>
<html lang="en">

<head>
    <?php
    require_once("includes/header.php");
    require_once("includes/head.php");
    ?>
    <title><?php echo($gu_fullname);?></title>
    <link rel="stylesheet" href="style/home_style2.css">
    
</head>

<body>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="well">
                <?php
                echo ("<div class='container'><a href='user_profile.php?user_id=$gu_id'><img src='$gu_image' class='img-circle' width='50' height='50'>&nbsp;&nbsp;$gu_name</a></div>");
                ?>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div id="messages_id" style="border: 5px solid #e6e6e6;
                padding: 40px 5px;" onloadeddata="chatAdjust(this)">
                <script>
                        function chatAdjust(element) {
                            element.style.height = "1px";
                            element.style.height = (25 + element.scrollHeight) + "px";
                        }
                    </script>
                   <?php require_once("get_messages.php"); ?>
                    
                </ul>

                    </div>
        </div>
        <div class="col-sm-2"></div>
    </div><br>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div id="message_box">
                <form action="chat.php?user_id=<?php echo($fu_id);?>" method="post">
                    <textarea name="message" class="form-control" cols="83" rows="4" style="resize: none;" required onkeyup="textAreaAdjust(this)"></textarea><br>
                    <script>
                        function textAreaAdjust(element) {
                            element.style.height = "1px";
                            element.style.height = (25 + element.scrollHeight) + "px";
                        }
                    </script>
                    <input type="submit" name="send" class="btn btn-info" style="float:right;width:30%;" value="Send">
                </form>
                <?php
                    if (isset($_POST['send'])) {
                        $message_content = htmlentities(mysqli_real_escape_string($conn,$_POST['message']));
                        if($message_content<1){
                            echo("<script>alert('Message can not be blank');</script>");
                            echo("<script>windows.open('chat.php?user_id='$fu_id'','_self');</script>");
                        }
                        $sendq = "insert into messages(my_id,user_id,message_content) values('$su_id','$gu_id','$message_content')";
                         mysqli_query($conn,$sendq);
                        
                        $coount = mysqli_affected_rows($conn);
                        if($coount == 1 ){
                            $chat_active_query = "update friends set chat_active='YES' where my_id='$su_id' and user_id='$fu_id'";
                            mysqli_query($conn,$chat_active_query);
                            echo("<script>alert('Message Sent');</script>");
                            
                            echo("<script>windows.open('chat.php?user_id='$fu_id'','_self');</script>");
                        }
                    }
                ?>

                
            </div>
            <div class="col-sm-2"></div>
            
        </div>
    </div>
</body>

</html>
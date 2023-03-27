<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password</title>
    <?php 
    require_once("includes/head.php");
    require_once("includes/conn.php");
    ?>
    
    <link rel="stylesheet" href="style/signup.css">
</head>

<body>
    <?php require_once("includes/well.php") ?>
    <section id="middle">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <div class="header">
                        <h3 style="text-align: center;"><strong>Change your Password</strong></h3>
                    </div><br>
                    <div class="l-part">
                        <form class="form-group" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Username"  required="required">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" minlength="8" required="required">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="conpass" class="form-control" placeholder="Confirm Password" minlength="8" required="required">
                            </div><br>
                           
                                <br><br>
                            <input type="submit" name="change" class="btn btn-primary rouder form-control" value="Change Password">
                        </form>
                       
                        <?php 
                            if(isset($_POST["change"])){
                                $username = htmlentities(mysqli_real_escape_string($conn,$_POST["username"]));
                                $password =htmlentities(mysqli_real_escape_string($conn,$_POST["password"]));
                                $encpass = md5($password);
                                $conpass = htmlentities(mysqli_real_escape_string($conn,$_POST["conpass"]));
                                if (strlen($password)<8) {
                                    echo("<script>alert('Password should be 8 characters long');</script>");
                                }
                                else  if($conpass != $password){
                                    echo("<script>alert('Password did not match');</script>");
                                }
                                else {
                                    $query = "UPDATE users SET password='$encpass' WHERE username = '$username'";
                                    mysqli_query($conn,$query);
                                    $res = mysqli_affected_rows($conn);
                                    mysqli_close($conn);
                                    if($res == 1){
                                        echo("<script>alert('Password changed successfully');</script>");
                                        echo("<script>window.open('login.php','_self');</script>");
                                    }else{
                                        echo("<script>alert('Something went wrong!');</script>");
                                    }
                                }
                                
                            }
                        ?>

    </section>

</body>

</html>
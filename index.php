<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Socializer</title>

<?php require_once("includes/head.php")?>
<link rel="stylesheet" href="style/index.css">
</head>
<body>
<?php require_once("includes/well.php")?>

    <section id="middle">
        <div class=" row ">
            <div class="col-md-5 flagged1 container-fluid ">
                <h2 class="co-white"><span class="glyphicon glyphicon-search"></span><strong>Follow your Interest.</strong></h2>
                <h2 class="co-white"><span class="glyphicon glyphicon-search"></span><strong>Hear what people are talking about.</strong></h2>
                <h2 class="co-white"><span class="glyphicon glyphicon-search"></span><strong>Join the Conversation.</strong></h2>
            </div>
            <div class="col-md-5 container-fluid flagged2">
                <h1 class="text-primary justify-content-center"><strong>Socializer</strong></h1>
                <h2><strong>See what's happening in <br> the world right now.</strong></h2>
                <h2>Join Socializer now!</h2>
                <br><br>
                <form class="form-group" method="post">
                    <input type="submit" name="signup" class="btn btn-success rounded form-control" value="Signup"><br><br>
                    <input type="submit" name="login" class="btn btn-primary  rounded form-control" value="Login"><br><br>

                </form>
                <?php
                if (isset($_POST["signup"])) {
                    header("Location:signup.php");
                }

                if (isset($_POST["login"])) {
                    header("Location:login.php");
                }

                ?>

            </div>
        </div>
    </section>
   <?php require_once("includes/footer.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Socializer|Reset Your Password</title>
    <?php require_once("includes/head.php"); ?>

    <link rel="stylesheet" href="style/signup.css">
</head>

<body>
    <?php require_once("includes/well.php") ?>
    <section id="middle">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <div class="header">
                        <h3 style="text-align: center;"><strong>Reset your Password</strong></h3>
                    </div><br>
                    <div class="l-part">
                        <form class="form-group" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Username" required="required">
                            </div><br>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password" class="form-control" minlength="8" placeholder="Password" required="required">

                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="conpass" class="form-control" minlength="8"  placeholder="Confirm Password" required="required">

                            </div><br>

                            <input type="submit" name="resetpass" class="btn btn-primary rouder form-control" value="Reset" />
                        </form>

                        <?php
                            include("functions/reset.php");
                        ?>

    </section>

</body>

</html>
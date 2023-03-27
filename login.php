<!DOCTYPE html>
<html lang="en">

<head>
    <title>Socializer|Login</title>
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
                        <h3 style="text-align: center;"><strong>Login to Socializer</strong></h3>
                    </div><br>
                    <div class="l-part">
                        <form class="form-group" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Username" required="required">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="required">
                            </div><br>
                            <a href="reset.php" style="float:right; text-decoration:none;font-size:18px;">Forgot?</a>
                                <br><br>
                            <input type="submit" name="login" class="btn btn-primary rouder form-control" value="Login">
                        </form>
                        <a href="signup.php" class="btn btn-success form-control">Signup</a>
                        <?php include("functions/login_user.php"); ?>

    </section>

</body>

</html>
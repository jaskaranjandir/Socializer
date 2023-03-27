<!DOCTYPE html>
<html lang="en">

<head>
    <title>Socializer|Signup</title>
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
                        <h3 style="text-align: center;"><strong>Join Socializer</strong></h3>
                    </div><br>
                    <div class="l-part">
                        <form class="form-group" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                <input type="text" name="fullname" class="form-control" placeholder="Full Name" required="required">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Username" required="required">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email" required="required">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" minlength="8" required="required">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                <select class="form-control" name="country" required="required">
                                    <option selected disabled>Select your Country</option>
                                    <option>France</option>
                                    <option>Germany</option>
                                    <option>India</option>
                                    <option>Japan</option>
                                    <option>Pakistan</option>
                                    <option>UK</option>
                                    <option>USA</option>
                                </select>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                <select class="form-control" name="gender" required="required">
                                    <option selected disabled>Select your Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Others</option>
                                </select>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input type="date" name="dob" class="form-control" required="required">
                            </div><br>
                            <a href="login.php" style="text-decoration: none; float:right;color:#187FAB;" data-toggle="tooltip" title="Login">Already a member?</a><br><br>
                            <input type="submit" name="signup" class="btn btn-success rouder form-control" value="Signup">
                        </form>
                        <?php include("functions/save_user.php");?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
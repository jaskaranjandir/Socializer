<!DOCTYPE html>
<?php
require_once("includes/conn.php");
session_start();
include("includes/header.php");
if (!isset($_SESSION['username'])) {
    header("location:index.php");
} else {
    $user_name = $_SESSION['username'];
    $query = "select * from users where username='$user_name'";
    $res = mysqli_query($conn,$query);
    
    $row = mysqli_fetch_array($res);
    $full_name = $row['fullname'];
    $db_user_name = $row['username'];
    $db_email = $row['email'];
    $pass_word = $row['password'];
    $f_country = $row['country'];
    $f_gender = $row['gender'];
    $fdob = $row['dob'];
    $f_relationship = $row['relationship'];
    $f_describe_user = $row['describe_user'];
    $f_recovery = $row['recovery_account'];
}

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
}

?>
<html lang="en">

<head>

    <?php
    require_once("includes/head.php");
    ?>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style/home_style2.css">
</head>

<body>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6" id="posts">
            <form method="post">
                
                <div class="form-group">
                    <label class="form-label" style="color:#000;">Full Name</label>
                    <input type="text" name="fullname" class="form-control" value="<?php echo($full_name);?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" style="color:#000;">Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo($db_user_name);?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" style="color:#000;">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo($db_email);?>" required>
                </div>
               
                <div class="form-group">
                    <label class="form-label" style="color:#000;">Country</label>
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
                </div>
                <div class="form-group">
                    <label class="form-label" style="color:#000;">Gender</label>
                    <select name="gender" class="form-control" required>
                        <option disabled>Choose Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" style="color:#000;">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="<?echo($fdob);?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" style="color:#000;">Describe User</label>
                    <input type="text" name="describe_user" class="form-control" value="<?php echo($f_describe_user);?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label" style="color:#000;">Relationship</label>
                    <select name="relationship" class="form-control">
                        <option disabled>Select Relationship Status</option>
                        <option>Married</option>
                        <option>Unmarried</option>
                    </select>
                </div>


                <div class="form-group">
                    <label class="form-label" style="color:#000;">Recovery Account</label>
                    <input type="text" name="recovery" class="form-control" value="<?php echo($f_recovery);?>" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="btn" value="Update profile">
                </div>

            </form>
            <?php
                if (isset($_POST['btn'])) {
                    $fullname = htmlentities($_POST['fullname']);
                    $username = htmlentities($_POST['username']);
                    $email = htmlentities($_POST['email']);
                    
                    $country = htmlentities($_POST['country']);
                    $gender = htmlentities($_POST['gender']);
                    $dob = htmlentities($_POST['dob']);
                    $describe_user = htmlentities($_POST['describe_user']);
                    $relationship = htmlentities($_POST['relationship']);
                    $recovery = htmlentities($_POST['recovery']);
                    $encpass = md5($password);

                    $update_user = "UPDATE users SET fullname='$fullname',username='$username',email='$email',country='$country',gender='$gender',dob='$dob',describe_user='$describe_user',relationship='$relationship',recovery_account='$recovery' WHERE user_id='$user_id'";

                    mysqli_query($conn,$update_user);
                    $rescount = mysqli_affected_rows($conn);
                    if($rescount >=1){
                        echo("<script>alert('Profile updated ');</script>");
                        echo("<script>window.open('profile.php?user_id=$user_id','_self');</script>");
                    }
                }
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>

</body>

</html>
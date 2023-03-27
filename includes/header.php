<?php include("conn.php"); ?>
<nav class="navbar navbar-default" style="background-color:#4aaee7; width:100%;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" aria-expanded="false" data-target="#headnav">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="home.php" class="navbar-brand" style="color: #ffffff;margin-top:10px;"><strong>Socializer</strong></a>
        </div>
        <div class="collapse navbar-collapse " id="headnav">
            <ul class="nav navbar-nav" style="margin-top: 10px;">
                <?php
                $user = $_SESSION['username'];
                $user_query = "select * from users where username='$user'";
                $user_result = mysqli_query($conn, $user_query);
                $user_row = mysqli_fetch_array($user_result);
                $user_id = $user_row['user_id'];
                $fullname = $user_row['fullname'];
                $username = $user_row['username'];
                $email = $user_row['email'];
                $password = $user_row['password'];
                $country = $user_row['country'];
                $gender = $user_row['gender'];
                $dob = $user_row['dob'];
                $status = $user_row['status'];
                $user_image = $user_row['user_image'];
                $user_cover = $user_row['user_cover'];
                $describe_user = $user_row['describe_user'];
                $relationship = $user_row['relationship'];
                $recovery = $user_row['recovery_account'];
                $reg_date = $user_row['user_registration_date'];

                $post_query = "select * from posts where user_id='$user_id'";
                $post_result = mysqli_query($conn, $post_query);
                $post_count = mysqli_num_rows($post_result);
                ?>
                <li><a style="color: #ffffff; font-size:16px;" href='profile.php?<?php echo ("user_id=$user_id"); ?>'><strong><?php echo (ucwords($fullname)); ?></strong></a></li>
                <li><a style="color: #ffffff; font-size:16px;" href='home.php'>Home</a></li>
                <li><a style="color: #ffffff; font-size:16px;" href='find.php'>Find People</a></li>
                <li><a style="color: #ffffff; font-size:16px;" href='messages.php?user_id=<?php echo $user_id; ?>'>Messages</a></li>
                <?php
                echo ("
                    <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false' style='color:#000;'>More &nbsp;&nbsp;<span><i class='glyphicon glyphicon-chevron-down'></i></span></a>
                        <ul class='dropdown-menu' style='background-color:#4aaee7;' >
                            <li>
                                <a href='my_post.php?user_id=$user_id' style='color:#fff;'>My Posts &nbsp; <span class='badge badge-secondary'>$post_count</span></a>
                            </li>
                            <li role='seperator' class='divider'></li>
                            <li>
                                <a href='edit_profile.php?user_id=$user_id' style='color:#fff;'>Edit Account</a>
                            </li>
                           
                            
                        </ul>
                    </li>
                    ");
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href='logout.php'  style="color:#4aaee7;background-color:#fff;margin:10px;border-radius:10px;"><strong>Logout</strong></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
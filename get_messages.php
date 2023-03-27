<?php
                          
                            $mess = "select * from messages where (my_id='$su_id' and user_id='$gu_id') or (my_id='$gu_id' and user_id='$su_id')";
                            $mress = mysqli_query($conn,$mess);
                            $mcount = mysqli_num_rows($mress);
                            if ($mcount>0) {
                                while($mrow = mysqli_fetch_array($mress))
                                {
                                    $my_id = $mrow['my_id'];
                                    $ru_id = $mrow['user_id'];
                                    $sender_name = $su_name;
                                    $sender_image = $su_image;
                                    $reciever_name = $gu_name;
                                    $reciever_image = $gu_image;
                                    $message = $mrow['message_content'];
                                    
                                    if($my_id == $su_id){
                                        echo("
                                        <ul class='navbar nav'>
                                        <li class='pull-right' style='margin:0 5px;'><img src='$sender_image' class='img-circle' height='50' width='50'></li>
                                        
                                        <li class='btn btn-info pull-right' style='border-radius: 10px 0 10px 10px;'>
                                            <p>$message </p>
                                        </li>
                                        </ul>
                                        ");
                                    }
                                    else{
                                        if($my_id != $su_id){
                                            $rq = "Select * from users where user_id='$my_id'";
                                            $rres = mysqli_query($conn,$rq);
                                            $rcc = mysqli_num_rows($rres);
                                            if($rcc>=1){
                                                $ccrow = mysqli_fetch_array($rres);
                                                $cuser_id = $ccrow['user_id'];
                                                $cuser = $ccrow['username'];
                                                $cuser_image = $ccrow['user_image'];
        

                                            echo("
                                            <ul class='navbar nav'>
                                            <li class='pull-left' style='margin:0 5px;'><img src='$cuser_image' class='img-circle' height='50' width='50'></li>
                                            
                                            <li class='btn btn-info pull-left' style='border-radius: 0 10px 10px 10px;'>
                                                <p>$message </p>
                                            </li>
                                            </ul>
                                            
                                            ");
                                        }
                                    }
                                    
                                }
                            }
                            }
                          
                    ?>
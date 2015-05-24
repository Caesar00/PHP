<?php
    session_start();
    include "connection.php";
    error_reporting(-1);

    if(isset($_POST['login_btn']))
    {
        $isStudent = True;
        if(isset($_POST['account_type']) && $_POST['account_type'] == 'staff')
        {
            $isStudent = False;
        }

        if($isStudent) 
        {
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $query = "SELECT App_NO FROM applicant WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($con,$query) or die(mysqli_error($con));

            if(mysqli_num_rows($result) == 1)
            {
                $id = mysqli_fetch_array( $result );
                $_SESSION["id"] = $id['App_NO'];
                $_SESSION["role"] = 'stu';
                session_commit();
                header("Location: student_index3.php?cont=MLS");
            }
            else
            {
                $login_err = "Invalid Username or Password.";
            }
        }
        else
        {
            $id= mysqli_real_escape_string($con, $_POST['username']);// username entered of person logged in
            $password= mysqli_real_escape_string($con, $_POST['password']);
            $get_user_res = mysqli_query($con, "SELECT * FROM staff_account WHERE BINARY S_NO = BINARY '$id' AND BINARY password = BINARY md5('$password')");

            if (mysqli_num_rows($get_user_res) == 1) //if login record is correct
            {
                if(isset($_SESSION))
                {
                    unset($_SESSION);
                    session_destroy();
                    session_start();
                }
                $user = mysqli_fetch_array( $get_user_res );            
                $staff_id=$user['S_NO']; 
                $status=$user['type'];
                $last_login=$user['last_login'];
                $_SESSION['staff_id'] = $staff_id;            
                $_SESSION['status'] = $status;            
                $_SESSION['user'] = $user;
                $_SESSION["role"] = 'sta';
                session_commit();
                mysqli_query($con,"UPDATE staff_account SET last_login = now() WHERE S_NO='$staff_id'");
                if(!isset($page))
                {
                    if($status == "Sup")
                    {
                        header("Location: staff_index3.php?cont=MLS");
                    }
                    else if($status == "GRO")
                    {
                        header("Location: gro_index.php"); //jump to another page
                    }
                    else if($status == "Dean")
                    {
                        header("Location: dean_index.php");
                    }
                }
                else {
                    header("Location: " .$page); //jump to previous page that user access straight
                }
            }
            else 
            {
                $login_err="Invalid Username or Password.";
            }
        }
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>HDR+ Login</title>
    </head>
        <style type="text/css">
          .centeredImage
            {
                text-align:center;
                margin-top:30px;
                margin-bottom:0px;
                padding:0px;
            }
        </style>
        <?php include "resources.php"; ?>
    <body>
        <div id="loginPanel" class="jumbotron vertical-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center">
                                <h1>

                                    <a href="index3.php" style="text-decoration:none; color:inherit">HDR <i class="fa fa-plus"> </i></a>
                                </h1>
                            </div>
                        <?php 
                            if(isset($login_err)) {
                                if($isStudent) {
                                    $type = 'student';
                                }
                                else {
                                    $type = 'staff';
                                }
                                echo '<div class="alert alert-dismissable alert-danger text-center">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Incorrect '.$type.' username or password. </strong>Please try again.
                                </div>'; 
                            }
                            
                            if(isset($_SESSION['info'])) {
                                echo '<div class="alert alert-dismissable alert-warning text-center">
                                      <button type="button" class="close" data-dismiss="alert">×</button>'.$_SESSION['info'].'</div>'; 
                                unset($_SESSION['info']);
                            }
                        ?>
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST">
                                  <fieldset>
                                    <div class="form-group">
                                      <label for="inputEmail" class="col-md-offset-3 col-md-2 control-label">Username</label>
                                      <div class="col-md-4">
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputPassword" class="col-md-offset-3 col-md-2 control-label">Password</label>
                                      <div class="col-md-4">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="col-md-offset-3 col-md-6">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default active" id="student_btn">
                                                <input type="radio" name="account_type" value="student" checked>
                                                <i id="student-tick" class="fa fa-check-circle"></i> Student
                                            </label>
                                            <label class="btn btn-default" id="staff_btn">
                                                <input type="radio" name="account_type" value="staff">
                                                <i id="staff-tick" class="fa fa-check-circle" style="display:none"></i> Staff
                                            </label>
                                          </div>
                                      </div>
                                      <script>
                                        $("#student_btn").click(function() {
                                            $("#student-tick").show();
                                            $("#staff-tick").hide();
                                        });

                                        $("#staff_btn").click(function() {
                                            $("#staff-tick").show();
                                            $("#student-tick").hide();
                                        });
                                      </script>
                                    </div>
                                    <div class="form-group">
                                      <div class="col-md-offset-3 col-md-6">
                                        <button type="submit" name="login_btn" value="login" class="btn btn-primary btn-block">Log in</button>
                                      </div>
                                    </div>
                                  </fieldset>
                                </form>
                            </div>
                        </div>
<p class="centeredImage" href="http://www.murdoch.edu.au"><img src="Image/Logo/Logo.png" width="120" class="img-rounded"></img></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>



    <?php 

    if(!isset($_SESSION['staff_id']))
    {
        header("Location: staff_login.php?page=gro_profile.php");//force to login first
    }
    if($_SESSION['status']!="GRO")
    {
        header( "Location: 403error.php" );
    }



    /*		initialize variables		*/

   
    /*		end of variables		*/


    $staff_id=$_SESSION['staff_id'];
    $get_user_res = mysqli_query($con,"SELECT * FROM staff_account WHERE S_No = '$staff_id'");
    while($user = mysqli_fetch_array( $get_user_res )) 
    {
            $salutation=$user['salutation'];
            $firstname=$user['firstname'];
            $lastname=$user['surname'];
            $email=$user['email'];
    }
    $fullname = $firstname." ".$lastname;
    



    if (isset($_POST['update'])) 
    {
            $err="";

//            // check FOR selected
//            if(($_POST['FOR1']=="")||($_POST['FOR2']=="")||($_POST['FOR3']=="")){
//        $errfor ="Please select all 3 FOR";
//            $err = "Yes";
//        }
//            if(($_POST['FOR1']!="")&&($_POST['FOR2']!="")&&($_POST['FOR3']!=""))
//            {
//                    $FOR1=$_POST['FOR1'];
//                    $FOR2=$_POST['FOR2'];
//                    $FOR3=$_POST['FOR3'];
//                    if($FOR1==$FOR2 || $FOR2==$FOR3 || $FOR1==$FOR3)
//                    {
//                            $err = "Yes";
//                            $errfor = "Please select a different FOR";
//                    }
//            }
//            if(($_POST['researcher_keyword1']=="")||($_POST['researcher_keyword2']=="")||($_POST['researcher_keyword3']=="")||($_POST['researcher_keyword4']=="")||($_POST['researcher_keyword5']=="")){
//        $errresearch ="Please enter all 5 research keywords";
//            $err = "Yes";
//        }

            if($err =="")
            {
                $email_query = "";
                $chng_pass_query = "";
                $old_pass_query="";
                if(mysqli_real_escape_string($con,$_POST['email'])!=$email)
                {
                    $email=  mysqli_real_escape_string($con,$_POST['email']);
                    $email_query="email='$email'";
                }
                
                if(isset($_POST['chngPass']))
                {
                    if($_POST['newPass']==$_POST['confirmPass'])
                    {
                        $newPass = mysqli_real_escape_string($con,$_POST['newPass']);
                        $oldPass = mysqli_real_escape_string($con,$_POST['oldPass']);
                        if($newPass==$_POST['newPass'])
                        {
                            $chng_pass_query="password=md5('$newPass')";
                            $old_pass_query = " AND password=md5('$oldPass')";
                        }
                    }
                    else // show error newPass != confirmPass
                    {
                        
                    }
                }
//                    $_SESSION['FOR1'] = $FOR1;
//                    $_SESSION['FOR2'] = $FOR2;
//                    $_SESSION['FOR3'] = $FOR3;
//                    $_SESSION['researcher_keyword1'] = $_POST['researcher_keyword1'];
//                    $_SESSION['researcher_keyword2'] = $_POST['researcher_keyword2'];
//                    $_SESSION['researcher_keyword3'] = $_POST['researcher_keyword3'];
//                    $_SESSION['researcher_keyword4'] = $_POST['researcher_keyword4'];
//                    $_SESSION['researcher_keyword5'] = $_POST['researcher_keyword5'];


                    //code to place hereupload into database

                $upd_query = "UPDATE staff_account SET $email_query".($email_query!="" && $chng_pass_query!="" ? "," : ""). $chng_pass_query ." WHERE S_No='$staff_id'".$old_pass_query;
                    mysqli_query($con, $upd_query);
                    /** update research keywords into the db */
//                    mysqli_query($con,"UPDATE academic_staff SET researcher_keyword1 =?, researcher_keyword2 =?,
//                        researcher_keyword3 ='$_SESSION['researcher_keyword1']', researcher_keyword4 =?, researcher_keyword5 =? 
//                        WHERE staff_id=?");
//                        $_SESSION['researcher_keyword2'],$_SESSION['researcher_keyword3'],
//                        $_SESSION['researcher_keyword4'],$_SESSION['researcher_keyword5'],$staff_id));


                    //to delete all rows of the FOR int he Foreign key and insert again
//                    prepStmt("DELETE FROM select_for2 WHERE staff_id=?", "s", $staff_id);
                    /** @var Array Values to be inserted, most likely multi dimensional array. */
//                    $insArray = array();
//                    /** @var int A count of the number of rows to be inserted */
//                    $arrCount = 0;
//                    if(isset($_SESSION['FOR3'])&&$_SESSION['FOR3']!="")
//                    {
//                        $insArray[$arrCount++] = array($staff_id, $_SESSION['FOR3']);
//                    }
//                    if(isset($_SESSION['FOR2'])&&$_SESSION['FOR2']!="")
//                    {
//                        $insArray[$arrCount++] = array($staff_id,$_SESSION['FOR2']);
//                    }
//                    if(isset($_SESSION['FOR1'])&&$_SESSION['FOR1']!="")
//                    {
//                        $insArray[$arrCount++] = array($staff_id,$_SESSION['FOR1']);
//                    }
//                    if($arrCount>0)
//                    {
//                        inserts("select_for2", "`staff_id`,`code`","ss", $insArray);
//                    }

                    date_default_timezone_set('Australia/Perth'); // set to Perth time

                    /** update last login of the user to notify when the */
//                    prepStmt("UPDATE academic_staff SET last_login = now() WHERE staff_id=?", "s", $staff_id);
                    /** commit all changes to the session */
                    session_commit();
                    header("Location: gro_index.php");
            }
    }
    ?>



    <table width="100%" align="center">

      <tr>
        <td>
          <form id="form1" name="form1" method="post" action="">
           <div class="container1">

                            <table width="60%" border="0" align="center" id="outertable">
                                <div><h1 class="title">My Profile<hr/></h1></div>
                            <tr class="text">
                                    <td style="padding:5px 40px;"><em>
                                    Please contact the administrator if your personal details are wrong. </em>
                                    </td>
                            </tr>
                            <tr class="text">
                                    <td ><p><strong>Salutation:</strong>
                                    <select name="salutation" id="personal1" disabled>
                                            <option value=""> - </option>
                                            <option value="Mr">Mr.</option>
                                            <option value="Ms" >Ms.</option>
                                            <option value="Mrs" >Mrs.</option>
                                            <option value="Mdm" >Mdm.</option>
                                            <option value="Prof" >Prof.</option>
                                            <option value="Dr">Dr.</option>
                                    </select>
                                    <?php
                                        /** Set selected salutation to the one queried from the database. */
                                        echo "<script type='text/javascript'> document.getElementById('personal1').value = '".$salutation."'</script>";
                                    ?>
                                          
                                    </p>
                                    <p><strong>First/Given Name:</strong>
                                    <input id="personal1" name="firstname" class="name" style="width:250px;"  disabled type="text" 
                                    value="<?php echo $firstname; ?>"/>
                                    </p>
                            <p><strong>Last/Family Name: </strong>
                            <input id="personal1" name="lastname" class="name" style="width:250px;"  type="text"  disabled value="<?php  echo $lastname;?>"/>
                            </p>
                            <p><strong>Email Address: </strong>
                            <input type="text" name="email" id="email" style="width:250px;" value="<?php echo $email; ?>" />	
                            </p>
                            <p><strong>Change Password: </strong>
                                <input type="checkbox" name="chngPass" id="chngPass" value="chngPass" onclick="(document.getElementById('chngPass').checked==1 ? show('passChng') : hide('passChng'))"/>	
                            </p>
                            <div id="passChng" class="none">
                            <p><strong>Old Password:</strong>
                            <input type="password" name="oldPass" id="oldPass" style="width:250px;" />
                            </p>
                            <p><strong>New Password:</strong>
                            <input type="password" name="newPass" id="newPass" style="width:250px;" />
                            </p>
                            <p><strong>Confirm New Password:</strong>
                            <input type="password" name="confirmPass" id="confirmPass" style="width:250px;" />
                            </p>
                            </div>
                                    </td>
                            </tr>
                            
                            
             <tr>
             <td style="padding:5px 40px;" class="text">
                    <input type="submit" name="update" id="button" class="btn1"  value="Update" />
             </td>
             </tr>
       </table>
       <p>&nbsp;</p>
           </div>
          </form></td>
      </tr>
      <tr>
        <td>

        <?php
            include ("footer.php");
            ?>

        </td>
      </tr>
    </table>
    <p>&nbsp;</p>
    </body>
</html>

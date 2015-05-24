<?php 
    include 'connection.php';
    session_start(); 

    if(!isset($_SESSION['staff_id']))
    {
        header("Location: staff_login.php?page=Staff_ProfilePage.php");//force to login first
    }
    if($_SESSION['status']!="Sup")
    {
        header( "Location: 403error.php" );
    }

    /*		initialize variables		*/

    $school_id="";
  
    $FOR1 = "";
    $FOR2 = "";
    $FOR3 = "";
    $researcher_keyword1="";
    $researcher_keyword2="";
    $researcher_keyword3="";
    $researcher_keyword4="";
    $researcher_keyword5="";
    /*		end of variables		*/


    $staff_id=$_SESSION['staff_id'];
    $get_user_res = mysqli_query($con,"SELECT * FROM supervisor,staff_account WHERE Sup_No = '$staff_id' AND supervisor.Sup_No=staff_account.S_No") or die(mysqli_error($con));
    while($user = mysqli_fetch_array( $get_user_res )) 
    {
            $salutation=$user['salutation'];
            $firstname=$user['firstname'];
            $lastname=$user['surname'];
            $school_id=$user['Sc_NO'];
            $email=$user['email'];
            $researcher_keyword1=$user['rsh_keyword1'];
            $researcher_keyword2=$user['rsh_keyword2'];
            $researcher_keyword3=$user['rsh_keyword3'];
            $researcher_keyword4=$user['rsh_keyword4'];
            $researcher_keyword5=$user['rsh_keyword5'];
            $highest_qual = $user['highest_qualification'];
    }
    $fullname = $salutation." ".$firstname." ".$lastname;
    $i=1;
    $for[1]="";
    $for[2]="";
    $for[3]="";
//        echo $staff_id;
    $get_user_for = mysqli_query($con,"SELECT * FROM sup_rsh_field WHERE Sup_No = '$staff_id'") or die(mysqli_error($con));
    while($getfor = mysqli_fetch_array( $get_user_for )) 
    {
        $for[$i]=$getfor['Rf_NO'];
        $i++;//to ensure that the code is saved in the first array, rahter than 0
    }
    $FOR1=$for[1];
    $FOR2=$for[2];
    $FOR3=$for[3];
    

    if (isset($_POST['update'])) 
    {
            $err="";

            // check FOR selected
            if(($_POST['FOR1']=="")||($_POST['FOR2']=="")||($_POST['FOR3']=="")){
        $errfor ="Please select all 3 FOR";
            $err = "Yes";
        }
            if(($_POST['FOR1']!="")&&($_POST['FOR2']!="")&&($_POST['FOR3']!=""))
            {
                    $FOR1=$_POST['FOR1'];
                    $FOR2=$_POST['FOR2'];
                    $FOR3=$_POST['FOR3'];
                    if($FOR1==$FOR2 || $FOR2==$FOR3 || $FOR1==$FOR3)
                    {
                            $err = "Yes";
                            $errfor = "Please select a different FOR";
                    }
            }
            if(($_POST['researcher_keyword1']=="")||($_POST['researcher_keyword2']=="")||($_POST['researcher_keyword3']=="")||($_POST['researcher_keyword4']=="")||($_POST['researcher_keyword5']=="")){
        $errresearch ="Please enter all 5 research keywords";
            $err = "Yes";
        }

            if($err =="")
            {
                    $_SESSION['FOR1'] = $FOR1;
                    $_SESSION['FOR2'] = $FOR2;
                    $_SESSION['FOR3'] = $FOR3;
                    $_SESSION['researcher_keyword1']=mysqli_real_escape_string($con,trim($_POST['researcher_keyword1']));
                    $_SESSION['researcher_keyword2']=mysqli_real_escape_string($con,trim($_POST['researcher_keyword2']));
                    $_SESSION['researcher_keyword3']=mysqli_real_escape_string($con,trim($_POST['researcher_keyword3']));
                    $_SESSION['researcher_keyword4']=mysqli_real_escape_string($con,trim($_POST['researcher_keyword4']));
                    $_SESSION['researcher_keyword5']=mysqli_real_escape_string($con,trim($_POST['researcher_keyword5']));
                    
                    if(isset($_POST['chngPass']) && isset($_POST['newPass']) && isset($_POST['oldPass']))
                    {
                        if($_POST['newPass']==$_POST['confirmPass'])
                        {
                            $newPass = mysqli_real_escape_string($con,$_POST['newPass']);
                            $oldPass = mysqli_real_escape_string($con,$_POST['oldPass']);
                            if($newPass==$_POST['newPass'])
                            {
                                mysqli_query($con, "UPDATE staff_account SET password=md5('$newPass') WHERE S_NO='$staff_id' AND password=md5('$oldPass')") or die (mysqli_error($con));
                            }
                        }
                        else // show error newPass != confirmPass
                        {

                        }
                    }


                    //code to place hereupload into database

                    /** update research keywords into the db */
                    $rsh_keywords_quer = "UPDATE supervisor SET rsh_keyword1 = '$_SESSION[researcher_keyword1]', rsh_keyword2 ='$_SESSION[researcher_keyword2]', rsh_keyword3 ='$_SESSION[researcher_keyword3]', rsh_keyword4 ='$_SESSION[researcher_keyword4]', rsh_keyword5 ='$_SESSION[researcher_keyword5]' WHERE Sup_No='$staff_id'";
                    mysqli_query($con,$rsh_keywords_quer) or die (mysqli_error($con));


                    //to delete all rows of the FOR int he Foreign key and insert again
                    mysqli_query($con, "DELETE FROM sup_rsh_field WHERE Sup_No='$staff_id'");
                    /** @var int A count of the number of rows to be inserted */
//                        $arrCount = 0;
//                        if(isset($_SESSION['FOR3'])&&$_SESSION['FOR3']!="")
//                        {
//                            $insArray[$arrCount++] = array($staff_id, $_SESSION['FOR3']);
//                        }
//                        if(isset($_SESSION['FOR2'])&&$_SESSION['FOR2']!="")
//                        {
//                            $insArray[$arrCount++] = array($staff_id,$_SESSION['FOR2']);
//                        }
//                        if(isset($_SESSION['FOR1'])&&$_SESSION['FOR1']!="")
//                        {
//                            $insArray[$arrCount++] = array($staff_id,$_SESSION['FOR1']);
//                        }
//                        if($arrCount>0)
//                        {
//                            inserts("select_for2", "`staff_id`,`code`","ss", $insArray);
//                        }
                    if(isset($_SESSION['FOR1'])&&$_SESSION['FOR1']!="")
                    {
                            $for1 ="INSERT INTO sup_rsh_field VALUES('$staff_id','$_SESSION[FOR1]')";
                            $uploadfor1 = mysqli_query($con,$for1) or die (mysqli_error($con));
                    }
                    if(isset($_SESSION['FOR2'])&&$_SESSION['FOR2']!="")
                    {
                            $for2 ="INSERT INTO sup_rsh_field VALUES('$staff_id','$_SESSION[FOR2]')";
                            $uploadfor2 = mysqli_query($con,$for2) or die (mysqli_error($con));
                    }
                    if(isset($_SESSION['FOR3'])&&$_SESSION['FOR3']!="")
                    {
                            $for3 ="INSERT INTO sup_rsh_field VALUES('$staff_id','$_SESSION[FOR3]')";
                            $uploadfor3 = mysqli_query($con,$for3) or die (mysqli_error($con));
                    }

                    date_default_timezone_set('Australia/Perth'); // set to Perth time

                    /** update last login of the user to notify when the */
//                        prepStmt("UPDATE academic_staff SET last_login = now() WHERE staff_id=?", "s", $staff_id);
                    /** commit all changes to the session */
                    session_commit();
                    header("Location: Staff_CurrentStudent.php");
            }
        }
?>
<div class="container">
    <form class="form-horizontal" name="form1" method="post">
        <fieldset>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Profile Detail</h4>
                </div>
                <div class="panel panel-body">
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <h5 class="well">
                                <i class="fa fa-flag"></i> Please contact the administrator if your personal details are wrong.
                            </h5>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select1" class="col-sm-2 control-label">
                            Salutation
                        </label>
                        <div class="col-sm-2">
                            <select class="form-control" name="salutation" id="personal1">
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
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select1" class="col-sm-2 control-label">Surname Name</label>
                        <div class="col-sm-3">
                            <input id="personal1" name="firstname" class="form-control"  type="text" value="<?php echo $firstname; ?>"/>
                        </div>
                        <label for="personal1" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-3">
                            <input id="personal1" name="lastname" class="form-control" type="text"   value="<?php  echo $lastname;?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email Address</label>
                        <div class="col-sm-5">
                            <input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>" />	
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="school_id" class="col-sm-2 control-label">School</label>
                        <div class="col-sm-6">
                            <select name="school_id" id="school_id" class="form-control" >
                                <option value="1">Sir Walter Murdoch School of Public Policy and International Affairs</option>
                                <option value="2">School of Engineering and Information Technology</option>
                                <option value="3">School of Management and Governance</option>
                                <option value="4">School of Psychology and Exercise Science</option>
                                <option value="5">School of Health Professions</option>
                                <option value="6">School of Arts</option>
                                <option value="7">School of Education</option>
                                <option value="8">School of Law</option>
                                <option value="9">School of Veterinary and Life Sciences</option>
                            </select>
                            <?php
                                /** Set selected school to the one queried from the database. */
                                echo "<script type='text/javascript'> document.getElementById('school_id').value = '".$school_id."'</script>";
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="highest_qual" class="col-sm-2 control-label">Highest Qualification</label>
                        <div class="col-sm-3">
                            <select name="highest_qual" id="highest_qual" class="form-control" >
                                <option value="Deg">Bachelor Degree</option>
                                <option value="Hon">Bachelor Honours Degree</option>
                                <option value="Mst">Masters Degree</option>
                                <option value="PhD">Doctoral Degree</option>
                            </select>
                            <?php
                                /** Set selected qualification to the one queried from the database. */
                                echo "<script type='text/javascript'> document.getElementById('highest_qual').value = '".$highest_qual."'</script>";
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FOR" class="col-sm-2 control-label"><strong>Field Of Research: </strong></label>
                        <div class="col-sm-2">
                            <strong>1. </strong>
                             <select name="FOR1" id="FOR" class="form-control">
                                <option value="">--Please Select--</option>
                                <?php 
                                    $query = mysqli_query($con, "SELECT * FROM research ") or die(mysqli_error($con));
                                    //query to get record
                                    while ($row=mysqli_fetch_array($query))
                                    {
                                        echo "<option value='".$row['Rf_NO']."'";
                                        if(isset($_SESSION['staff_id'])&&($row['Rf_NO']==$FOR1)){echo 'selected';}
                                        echo ">".$row['description']."</option>\n";
                                    }
                                ?>
                            </select>
                            <strong>2. </strong>
                            <select name="FOR2" id="FOR" class="form-control">
                                <?php 
                                    //query to get record
                                    while ($row=mysqli_fetch_array($query)) 
                                    { 
                                        echo "<option value='".$row['Rf_NO']."'";
                                        if(isset($_SESSION['staff_id'])&&($row['Rf_NO']==$FOR2)){echo 'selected';}
                                        echo ">".$row['description']."</option>\n";
                                    }
                                ?>
                            </select>          
                            <strong>3. </strong>
                            <select name="FOR3" id="FOR" class="form-control">
                                <?php 
                                    //query to get record
                                    while ($row=mysqli_fetch_array($query))
                                    { 
                                        echo "<option value='".$row['Rf_NO']."'";
                                        if(isset($_SESSION['staff_id'])&&($row['Rf_NO']==$FOR3)){echo 'selected';}
                                        echo ">".$row['description']."</option>\n";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FOR" class="col-sm-2 control-label">
                            Research Keywords<font style="color:#FF0000"><?php if(isset($errresearch)) echo $errresearch; ?></font><br/>
                        </label>
                        <div class="col-sm-4">
                            <strong>1.</strong>
                            <input name="researcher_keyword1" type="text" class="form-control" value="<?php echo $researcher_keyword1; ?>"/>
                            <br />
                            <strong>2.</strong>
                            <input name="researcher_keyword2" type="text" class="form-control" value="<?php echo $researcher_keyword2; ?>"/>
                            <br />
                            <strong>3.</strong>
                            <input name="researcher_keyword3" type="text" class="form-control" value="<?php echo $researcher_keyword3; ?>"/>
                            <br />
                            <strong>4.</strong>
                            <input name="researcher_keyword4" type="text" class="form-control" value="<?php echo $researcher_keyword4; ?>"/>
                            <br />
                            <strong>5.</strong>
                            <input name="researcher_keyword5" type="text" class="name" value="<?php echo $researcher_keyword5; ?>" size="35"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="col-sm-2 control-label text-muted">Current</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control" id="oldPass" name="oldPass">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text2" class="col-sm-2 control-label">New</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" id="newPass" name="newPass">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text3" class="col-sm-2 control-label">Confirm</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Type in new password again">
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <input type="submit" name="update" id="button" class="btn btn-primary"  value="Update" />
                </div>
            </div>
        </fieldset>
    </form>
</div>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>HDR | Murdoch</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script src="js/libs.js"></script>
    </head>
    <body>
    <?php 

    session_start();
    include 'connection.php';

    if($_SESSION['status']!="Sup"){	//if not supervisor, redirect to GRO
        header( "Location: 403error.php" );
    }
    if(!isset($_SESSION['staff_id'])){
        header("Location: staff_login.php?page=Staff_CurrentStudent.php");//force to login first
    }
    $staff_id=$_SESSION['staff_id'];
    $get_user_res = mysqli_query($con,"SELECT * FROM staff_account WHERE S_No = '$staff_id'") or die (mysqli_error($con));
    while($user = mysqli_fetch_array($get_user_res)) 
    {
            $title=$user['salutation'];
            $firstname=$user['firstname'];
            $lastname=$user['surname'];
    }
    $fullname = $title." ".$firstname." ".$lastname; // show supervisor full name at top right with welcome message

    //SQL query to get student supervision percentage
    $getStudentsQuery = "SELECT * FROM sup_std INNER JOIN hdr_student 
        ON sup_std.Std_NO=hdr_student.Stud_NO INNER JOIN applicant ON hdr_student.App_NO=applicant.App_NO WHERE sup_std.Sup_NO='$staff_id' AND 
        sup_std.end_date >= now() ORDER BY Std_No";
    $studentlist_res = mysqli_query($con,$getStudentsQuery) or die(mysqli_error($con));

    $prorata=0;
    $protata=0; //used to calculate prorata
    $avail_sup=1;// to show if supervisor is available for more students/prorata, default 1 (yes)
    $i=1;
    foreach($studentlist_res as $student) 
    {
            $student_id[$i]=$student['Std_NO'];	
            $i++;
    }
    $errpercentage ="";


    if(isset($_POST['updatebtn']))
    {
                session_commit();
        $prorata = 0;
        
        for($i=1;$i<=count($student_id);$i++)
        {
                if(isset($_POST['supervision_percentage'.$i])&& $_POST['supervision_percentage'.$i]!="")
                {
                        $supervision_percentage[$i]=$_POST['supervision_percentage'.$i];
                }
                if(($supervision_percentage[$i] > 100 || $supervision_percentage[$i] < 20 ) ||!preg_match("/^(?:100|\d{1,2})?$/",$supervision_percentage[$i])||$supervision_percentage[$i]=="")
                {
                        $err="Yes";
                        $errpercentage ="Invalid Input and Percentage cannot be less than 20 or more than 100";
                }

                $prorata = $prorata + $supervision_percentage[$i];
                if($prorata > 300)
                {
                        $err ="Yes";
                        $errpercentage = "Total Supervision Percentage cannot be more than 300%";

                }
                if($prorata > 280)
                {
                        //change availability to no if remainder supervision percentage is less than 20
                        $avail_sup=0;
                }
        }

        if($err=="")
        {
                //change availability status for sup
                mysqli_query($con, "UPDATE supervisor SET available=$avail_sup WHERE Sup_No ='$staff_id'") or die (mysqli_error($con));
                for($i=1;$i<=count($student_id);$i++)
                {
                        //update supervision percentage
                        mysqli_query($con,"UPDATE sup_std SET sup_percentage=$supervision_percentage[$i] WHERE Std_NO ='$student_id[$i]' AND 
                            Sup_NO='$staff_id'") or die (mysqli_error($con));
                }
                session_commit();
                header("Location: Staff_CurrentStudent.php");
        }
    }


    ?>



        
            <?php 
            include("header.php");
            include ("Staffnav.php");
            ?>
        <table  width="100%" border="0" align="center">


          <tr>
            <td>
              <form id="form1" name="form1" method="post" action="" class="container1">
                <table  width="100%" border="0" align="center" id="outertable" >
                  <tr>
                    <td>
                                <h1 class="title">Current Students <hr /> </h1>
                                <table width="100%" border="0" align="center" class="text">
                                        <tr>
                                                <td >
                                                <font color='#FF0000'><?php echo $errpercentage;?></font>
                                                <table width="100%" border="1" align="center">
                                                        <tr>
                                                                <th width="20%">Student Number</th>
                                                                <th width="50%">Student Name</th>
                                                                <th width="30%">Supervision Percentage (%)</th>
                                                        </tr>

                                                <?php

                                                    $i=1; // counter

                                                    //SQL query to get student supervision percentage
                                                    foreach($studentlist_res as $student) 
                                                    {
                                                        $student_id[$i]=$student['Std_NO'];
                                                        $student_firstname[$i]=$student['firstname'];
                                                        $student_lastname[$i]=$student['surname'];
                                                        $student_fullname[$i] = $student_firstname[$i]." ".$student_lastname[$i];
                                                        $supervision_percentage[$i]=$student['sup_percentage'];
                                                        $prorata = $prorata+$supervision_percentage[$i];
                                                        if(isset($student_id[$i])&&$student_id[$i]!="")
                                                        {
                                                            echo "<tr><td>".$student_id[$i]."</td>";
                                                            echo "<td>".$student_fullname[$i]."</td>";
                                                            echo "<td style='width:99%;'><input type='text' style='width:97%;
                                                                height:97%;' maxlength='3' name='supervision_percentage".$i."'
                                                                ".(isset($_REQUEST['editbtn']) ? : "disabled"). " value='$supervision_percentage[$i]'></td>";
                                                            echo "</tr>";
                                                        }
                                                        $i++;
                                                    }
                                                    ?>

                                                </table>

                                                </td>
                                                <td rowspan="2" align="center" style='width:20%;'><?php 
                                        if(!isset($_REQUEST['editbtn']))
                                        { ?>
                                        <h2> Pro rata
                                        </h2>
                                        <h1><?php echo ($prorata/100); }?></h1>
                                </td>
                                        </tr>
                                        <tr>
                                        <td align="center" style='width:20%;'>
                                <?php 

                                if(isset($_REQUEST['editbtn'])){ ?>
                                <br><input style='width:99%;' type="submit" name="updatebtn" class="btn1" value="Update Supervision Percentage" />		
                                <?php } ?>
                                        </form><br>
                                        <form action="Staff_CurrentStudent.php?editbtn=supervision" method="post" >
                                                <?php
                                                if(!isset($_REQUEST['editbtn'])){ ?>
                                                <input type="submit" name="editbtn"  class="btn1" value="Edit Supervision Percentage" />
                                                <?php } 

                                                ?>
                                        </tr>

                                </table></td>
                  </tr>
                  <tr>
                        <td>&nbsp;</td>
                        </tr>
                </table>
            </form>
            </td>
          </tr>
          <tr>
            <td>

            <?php
                include ("footer.php");
                session_commit();
                ?>

            </td>
          </tr>
        </table>
        <p>&nbsp;</p>
    </body>
</html>

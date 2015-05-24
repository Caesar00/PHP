<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional/
/EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Graduate Research Office (View individual Expression of Intesrest)</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<?php 
session_start();
include "connection.php";
if(!isset($_SESSION['staff_id']))
{
header("Location: staff_login.php?page=GRO_ListOfEOI.php");
}//force to login first
if(isset($_SESSION['staff_id'])&&$_SESSION['status']!="GRO")
{
header("Location: 403error.php");//for non GRO accessing
}
    if(!isset($_POST['eoi_id']) && !isset($_SESSION['searcheoi']))
    {
    header("Location: GRO_ListOfEOI.php");
    }
$staff_id=$_SESSION['staff_id'];
$get_user = "SELECT * FROM staff_account WHERE S_NO = '$staff_id'";
$get_user_res = mysqli_query($con,$get_user) or die(mysqli_error($con));
while($user = mysqli_fetch_array( $get_user_res )) 
{
	$title=$user['salutation'];
	$firstname=$user['firstname'];
	$lastname=$user['surname'];
}
$fullname = $title." ".$firstname." ".$lastname; // show supervisor full name at top right with welcome message
$err="";
$errgroreason1="";
$errgroreason2="";

if(!isset($_POST['approve']) && !isset($_POST['pending']) && !isset($_POST['reject']) && isset($_POST['eoi_id']))
{
	$eoi_id = $_POST['eoi_id'];	
}
if(isset($_POST['approve']) || isset($_POST['pending']) || isset($_POST['reject']))
{
	$eoi_id = $_SESSION['eoiid'];
}
if(isset($_POST['groreason']) && trim($_POST['groreason'])=="")
{
	$err="Yes";
	$errgroreason1 ="<font color='#FF0000'>*";
	$errgroreason2 ="*</font>";
}
if($err=="")
{
	$_SESSION['groreason']= mysqli_real_escape_string($con,trim(isset($_POST['groreason']) ? $_POST['groreason'] : " "));
	if(isset($_POST['approve']))
	{	
		header('Location: matchup.php');
	}
	if(isset($_POST['pending']))
	{
		header('Location: pending.php');
	}
	if(isset($_POST['reject']))
	{
		$status_rej_query="UPDATE eoi SET groreason='$_SESSION[groreason]' WHERE eoi_no='$eoi_id'";
		$uploadrej = mysqli_query($con,$status_rej_query) or die (mysqli_error($con));
		header('Location: rejectionnotification.php');
	}
}
//extract information from the database using the selected eoi_id


$eoiquery ="SELECT * FROM eoi,applicant WHERE applicant.app_no= eoi.app_no AND eoi_no ='$eoi_id'";
$result =mysqli_query($con,$eoiquery) or die(mysqli_error($con));
while($row = mysqli_fetch_array($result))
{ 
	$salutation=$row['salutation'];
	$student_firstname=$row['firstname'];
	$student_lastname=$row['surname'];
	$country=$row['citizenship'];
	$mu_id=$row['mu_id'];
	$email=$row['email'];
	$telephone=$row['telephone'];
	$proposed_program=$row['proposed_program'];
	$school=$row['Sc_NO'];
	$commence_year=$row['commence_year'];
	$commence_month=$row['commence_month'];
	$full_part=$row['time_candidate'];
	
	$eng_lang=$row['eng_lang'];
	$eng_course_name=$row['eng_course_name'];
	$eng_course_result=$row['eng_test_score'];
	$eng_lang_test_type=$row['eng_test_type'];
	$eng_lang_test_score=$row['eng_test_score'];
	$test_date_res=$row['eng_test_date'];
	$scholarship_support1=$row['scholarship_sup1'];
	$scholarship_support2=$row['scholarship_sup2'];
	
	
	$why_research=$row['research_reason'];
	$eoi_status=$row['status'];
	$groreason=$row['gro_reason'];
}

$rsh_key_res=mysqli_query($con,"SELECT keyword FROM eoi_rsh_keyword WHERE 
    eoi_no='$eoi_id'") or die(mysqli_error($con));
$rsh_count = 1;
while($rsh_row=mysqli_fetch_array($rsh_key_res))
{
	$research_keywords[$rsh_count++]=$rsh_row['keyword'];
}
//-------------------------------------------------
$academic_res=mysqli_query($con,"SELECT eoi_academic.name AS ac_name, school.name AS sc_name, email 
    FROM eoi_academic,school WHERE eoi_academic.Sc_No=school.sc_no AND eoi_no='$eoi_id'") or die(mysqli_error($con));
$academic_count = 1;
while($academic_row=mysqli_fetch_array($academic_res))
{
	$academic_names[$academic_count]=$academic_row['ac_name'];
        $acadmic_schools[$academic_count]=$academic_row['sc_name'];
        $academic_emails[$academic_count++]=$academic_row['email'];
}
/* from eoi_academic
	$title_name1=$row['title_name1'];
	$school1=$row['school1'];
	$email1=$row['email1'];
	$title_name2=$row['title_name2'];
	$school2=$row['school2'];
	$email2=$row['email2'];
	*/
//-------------------------------------------------
$qual_res=mysqli_query($con,"SELECT * FROM eoi_qualification WHERE eoi_no='$eoi_id'") 
        or die(mysqli_error($con));
$qual_count = 1;
while($qual_row=mysqli_fetch_array($qual_res))
{
	$qual_degrees[$qual_count]=$qual_row['degree'];
	$qual_durations[$qual_count]=$qual_row['duration'];
	$qual_years[$qual_count]=$qual_row['year'];
	$gpas[$qual_count]=$qual_row['gpa'];
	$degree_researches[$qual_count]=$qual_row['completed_by_research'];
	$qual_institutes[$qual_count++]=$qual_row['institution'];
}
/* from eoi_qualification
	$degree1=$row['degree1'];
	$duration1=$row['duration1'];
	$years1=$row['years1'];
	$gpa1=$row['gpa1'];
	$degree_research1=$row['degree_research1'];
	$institution1=$row['institution1'];
	$degree2=$row['degree2'];
	$duration2=$row['duration2'];
	$years2=$row['years2'];
	$gpa2=$row['gpa2'];
	$degree_research2=$row['degree_research2'];
	$institution2=$row['institution2'];
	$degree3=$row['degree3'];
	$duration3=$row['duration3'];
	$years3=$row['years3'];
	$gpa3=$row['gpa3'];
	$degree_research3=$row['degree_research3'];
	$institution3=$row['institution3'];
*/
//-------------------------------------------------

$exp_res=mysqli_query($con,"SELECT * FROM eoi_experience WHERE eoi_no='$eoi_id'") 
        or die(mysqli_error($con));
$exp_count = 1;
while($exp_row=mysqli_fetch_array($exp_res))
{
	$positions[$exp_count]=$exp_row['position'];
        $employers[$exp_count]=$exp_row['institution'];
        $exp_years[$exp_count++]=$exp_row['year'];
}
/* from eoi_experience
	$position1=$row['position1'];
	$employer1=$row['employer1'];
	$years_appointed1=$row['years_appointed1'];
	$position2=$row['position2'];
	$employer2=$row['employer2'];
	$years_appointed2=$row['years_appointed2'];
	$position3=$row['position3'];
	$employer3=$row['employer3'];
	$years_appointed3=$row['years_appointed3'];
*/
//-------------------------------------------------

$pub_res=mysqli_query($con,"SELECT * FROM eoi_publication WHERE eoi_no='$eoi_id'") 
        or die(mysqli_error($con));
$pub_count = 1;
while($pub_row=mysqli_fetch_array($pub_res))
{
	$pub_titles[$pub_count]=$pub_row['title'];
        $pub_refs[$pub_count]=$pub_row['ref'];
        $pub_years[$pub_count++]=$pub_row['year'];
}
/* from eoi_publication
	$pub_years1=$row['pub_years1'];
	$pub_title1=$row['pub_title1'];
	$pub_ref1=$row['pub_ref1'];
	$pub_years2=$row['pub_years2'];
	$pub_title2=$row['pub_title2'];
	$pub_ref2=$row['pub_ref2'];
	$pub_years3=$row['pub_years3'];
	$pub_title3=$row['pub_title3'];
	$pub_ref3=$row['pub_ref3'];
	$pub_years4=$row['pub_years4'];
	$pub_title4=$row['pub_title4'];
	$pub_ref4=$row['pub_ref4'];
	$pub_years5=$row['pub_years5'];
	$pub_title5=$row['pub_title5'];
	$pub_ref5=$row['pub_ref5'];
*/
//-------------------------------------------------

$qmap_res=mysqli_query($con,"SELECT * FROM eoi_qmap WHERE eoi_no='$eoi_id'") 
        or die(mysqli_error($con));
$qmap_count = 1;
while($qmap_row=mysqli_fetch_array($qmap_res))
{
	$qmaps[$qmap_count]=$qmap_row['qmap'];
        $qmap_insts[$qmap_count]=$qmap_row['inst_nam_loc'];
        $qmap_years[$qmap_count++]=$qmap_row['year'];
}
/* from eoi_qmap
	$infor_years1=$row['infor_years1'];
	$infor_qual1=$row['infor_qual1'];
	$infor_institution1=$row['infor_institution1'];
	$infor_years2=$row['infor_years2'];
	$infor_qual2=$row['infor_qual2'];
	$infor_institution2=$row['infor_institution2'];
	$infor_years3=$row['infor_years3'];
	$infor_qual3=$row['infor_qual3'];
	$infor_institution3=$row['infor_institution3'];
	$infor_years4=$row['infor_years4'];
	$infor_qual4=$row['infor_qual4'];
	$infor_institution4=$row['infor_institution4'];
*/
//-------------------------------------------------

$schol_res=mysqli_query($con,"SELECT * FROM eoi_scholarship WHERE eoi_no='$eoi_id'") 
        or die(mysqli_error($con));
$schol_count = 1;
if(mysqli_num_rows($schol_res)>0)
{
    $scholarship_support3="yes";
    while($schol_row=mysqli_fetch_array($schol_res))
    {
	$schol_names[$schol_count]=$schol_row['name'];
        $sponsors[$schol_count]=$schol_row['sponsor'];
        $schol_values[$schol_count]=$schol_row['value'];
        $schol_durations[$schol_count]=$schol_row['duration'];
        $schol_purposes[$schol_count]=$schol_row['purpose'];
        $schol_statuses[$schol_count++]=$schol_row['status'];
    }   
}
else
    $scholarship_support3="no";

/* from eoi_scholarship
	// if select * from eoi_scholarship > 1 scholarship_support3 = yes;
	$scholarship_support3=$row['scholarship_support3'];
	$scholarship1=$row['scholarship1'];
	$sponsor1=$row['sponsor1'];
	$value1=$row['value1'];
	$duration_total1=$row['duration_total1'];
	$purposes1=$row['purposes1'];
	$scholarship_status1=$row['scholarship_status1'];
	$scholarship2=$row['scholarship2'];
	$sponsor2=$row['sponsor2'];
	$value2=$row['value2'];
	$duration_total2=$row['duration_total2'];
	$purposes2=$row['purposes2'];
	$scholarship_status2=$row['scholarship_status2'];
*/
//-------------------------------------------------

$test_date= date("d-M-Y", strtotime($test_date_res));
//select country name by another table
$country_query ="SELECT * FROM country WHERE citizenship ='$country'";
$citizenship_res =mysqli_query($con,$country_query) or die(mysqli_error($con));

while($get_citizenship = mysqli_fetch_array($citizenship_res))
{
	$citizenship=$get_citizenship['country'];
}
//split the name of the selected program
$programcounter = explode (",",$proposed_program);
$programselected ="";
for($i=0; $i < count($programcounter); $i++)
{
	$programselected .=$programcounter[$i]."&emsp;";
}
//echo school full name

$school_query ="SELECT * FROM school WHERE Sc_NO ='$school'";
$school_res =mysqli_query($con,$school_query) or die(mysqli_error($con));
while($get_school = mysqli_fetch_array($school_res))
{
	$schoolselected=$get_school['name'];
}
//FOR extraction
$resultfor = mysqli_query($con,"SELECT description FROM research,eoi_rsh_interested WHERE eoi_no ='$eoi_id' AND eoi_rsh_interested.Rf_No=research.Rf_No");
$for_count=1;
if($resultfor)
{
	while($get_for = mysqli_fetch_array($resultfor))
	{ 
		$FOR[$for_count++]=$get_for['description'];
	}
}


//echo sup school full name


if(!isset($_POST['approve']) && !isset($_POST['pending']) && !isset($_POST['reject']))
{
	$_SESSION['eoiid']= $eoi_id;
	$_SESSION['student_firstname']=$student_firstname;
	$_SESSION['student_lastname']=$student_lastname;
	$_SESSION['student_fullname']=$student_firstname." ".$student_lastname;
	$_SESSION['student_email']=$email;
}
session_commit();
?>
<body>
  <div>
  <?php
  include "header.php";
  include "GROnav.php";
  ?>
  </div>
 
 <div class="container1" align="center">
 <div class="title" style="margin-left:auto; margin-right:auto;width:100%;" >
   <h2>View individual Expression of Interest</h2>
 </div>
     <div style="width:80%" class="text">
		<div><h2>Expression of Interest ID: <?php echo $eoi_id; ?></h2></div>
		<?php if($eoi_status!=NULL){ ?><h3>EOI status : <?php echo $eoi_status; ?></h3>	<?php } ?>		
		<hr />
              <div class="title"><strong>1. Personal details</strong></div>
              <p><strong>Title: </strong><?php echo $salutation;	
	?><br/>
                <label for="Title"></label>
              </p>
              <p><strong>Family Name:</strong> <?php echo $student_firstname;	
	?><br/>
              </p>
              <p><strong>Given Name: </strong><?php echo $student_lastname;	
	?><br/>
              </p>
              <p><strong>Citizenship:</strong>
<label>
                  <?php if(isset($country)&& $country=="Domestic"){ ?>
                  Domestic (Australian/New Zealand Citizen or Australian Permanent Resident)<?php }?></label>
                <label>
                  <?php if(isset($country)&& $country!="Domestic"){ ?>
                  International - </label>
                <?php echo $citizenship;}?>
              </p>
              <p><strong>Have you previously applied for a program at Murdoch University?</strong>
<label>
                  <?php if(empty($mu_id)){ ?>
                  No<?php }?></label>
                <label> 
                  <?php if(!empty($mu_id)){ ?>
                Yes - MU Student Number <?php echo $mu_id;} ?></label>
              </p>
                  <br />
              <h2 class="title"><strong>2. Contact details</strong></h2>
              <p><strong>Email Address:</strong> <?php echo $email;	?><br/>
              </p>
              <p><strong>Telephone:</strong> <?php echo $telephone;	?><br/>
            </p> <br />
              <h2 class="title"><strong>3. Proposed enrolment</strong></h2>
              <p><strong>Program: </strong><?php echo $programselected; ?></p>
<p><strong>School: </strong><?php echo $schoolselected;	?></p>
              <h3>Commencing:              </h3>
              <p><strong>Month:</strong> <?php echo $commence_month; ?> <strong>Year:  </strong>
                <label><?php echo $commence_year;	?>&emsp;
                  <br />
                  <strong>Candidate:</strong> <?php echo ($full_part=='f' ? "Full" : "Part"). " Time"; ?></label>
              </p> <br />
              <h2 class="title"><strong>4. Research Interests</strong></h2>
              <strong>Field of Research:<br/></strong>
              <?php 
              if(isset($FOR))
              {
			  foreach($FOR as $for_key => $for_field)
			  {
			   echo "  <b>".$for_key.".</b> ".$for_field;
	?> 
              &emsp;
              <?php }}
              else {
                echo "N/A";
                }   ?> 
<p><strong>Research Keywords</strong>:<br/>
	<?php 
	if(isset($research_keywords))
        {
            foreach($research_keywords as $rsh_key => $word)
	{
            echo ' <b>'.$rsh_key.'.</b> '.$word;?>&emsp;
        <?php }}
        else {
            echo "N/A";
        }?>
<p><strong>Murdoch University academics  whom applicant wish to discuss their research interest with. </strong><br/>
</p>
<?php 
if((!isset($academic_names))) 
{ echo "N/A" ;}
else
{?>
<table class="list">
  <tr class="dark">
    <td><strong>Name</strong></td>
    <td><strong>School</strong></td>
    <td><strong>Email Address</strong></td>
  </tr>
  
	<?php foreach($academic_names as $academic_key => $academic_name){ ?>
  <tr class="light">
    <td><?php echo $academic_name;	
	?></td>
    <td><?php echo $acadmic_schools[$academic_key];	
	?></td>
    <td><?php echo $academic_emails[$academic_key];	
	?></td>
  </tr>
  <?php } ?>
</table>
<?php } ?>
</p> <br />
<h2 class="title"><strong>5. Academic Qualifications and Research Training Experience</strong></h2>
<p><strong>Qualifications attained for all previous  tertiary studies.</strong></p>
<?php 
  if(!isset($qual_degrees))
  {
      echo "N/A";
  }
  else
  {
      ?>
<table class="list">
  <tr class="dark">
    <th>Degree</th>
    <th>Duration <br />
      (No of years)</th>
    <th>Year<br>Awarded</th>
    <th>GPA<br />
      (Max 7.00)</th>
    <th>% of degree completed by research</th>
    <th>Institution</th>
  </tr>
  
  <?php
	  foreach($qual_degrees as $qual_key => $qual_degree)
	  { 
	  ?>
  <tr class="light">
    <td><?php echo $qual_degree;	
	?></td>
    <td><label for="select3"><?php echo $qual_durations[$qual_key];	
	?></label></td>
    <td><?php echo $qual_years[$qual_key];	
	?></td>
    <td><?php echo $gpas[$qual_key];	
	?></td>
    <td><?php echo $degree_researches[$qual_key];	
	?></td>
    <td><?php echo $qual_institutes[$qual_key];	
	?></td>
  </tr>
<?php } ?>

</table>
  <?php } ?>
<p><strong>List <u>all</u> previously relevant research experience/employment.</strong></p>
<?php 
if(!isset($positions))
{
    echo "N/A";
}
else
{
?>
<table class="list">
  <tr class="dark">
    <th>Position</th>
    <th>Employer/Institution</th>
    <th>Year Appointed</th>
  </tr>
  <?php
    foreach ($positions as $exp_key => $position)
    {
      ?>
  <tr clss="light">
    <td><?php echo $position;	
	?></td>
    <td><?php echo $employers[$exp_key];	
	?></td>
    <td><?php echo $exp_years[$exp_key];	
	?></td>
  </tr>
  <?php 
    }
?>
</table>
<?php } ?>

<p><strong>List your 5 most recent (or <u>all</u>) publications.</strong></p>
<?php 
if(!isset($pub_refs))
{
    echo "N/A";
}
else
{
?>
<table class="list">
  <tr class="dark">
    <th>Year</th>
    <th>Title</th>
    <th>Publication ref</th>
  </tr>
  <?php 
foreach ($pub_refs as $pub_key => $pub_ref)
    {
    ?>
  <tr class="light">
    <td><?php echo $pub_years[$pub_key];	?></td>
    <td><?php echo $pub_titles[$pub_key];	?></td>
    <td><?php echo $pub_ref; ?></td>
  </tr>
  <?php   } ?>
 
</table>
<?php } ?>



<p><strong>List any professional qualifications and memberships, awards and prizes, or additional relevant information</strong></p>
<?php
if(!isset($qmap_insts))
{
    echo "N/A";
}
else
{
?>

<table class="list">
  <tr class="dark">
    <th>Year</th>
    <th>Qualification/Membership/Award/Prize</th>
    <th>Name and Location of Institution</th>
  </tr>
  <?php
  foreach ($qmaps as $qmap_key => $qmap)
  {
      ?>
  <tr class="light">
    <td><?php echo $qmap_years[$qmap_key];	
	?></td>
    <td><?php echo $qmap;	
	?></td>
    <td><?php echo $qmap_insts[$qmap_key];	
	?></td>
  </tr>
  <?php } ?>
 
</table>
<?php } ?>
<br /><br />
<h2 class="title"><strong>6. English Language Proficiency</strong></h2>
<p><strong>All higher degree research applications are required to achieve an appropriate level of proficiency in academic English before they can commence their higher degree research program. </strong></p>
<p>
  <?php if(isset($eng_lang)&&$eng_lang==0) {?>
  English is my first language<?php }?> 
   <?php if(isset($eng_lang)&&$eng_lang==1) {?>
  I intend to sit an IELTS or TOEFL test at a later date <?php }?>
   <?php if(isset($eng_lang)&&$eng_lang==2) {?>
  I Have Completed an IELTS or TOEFL test within the past two years to the required standard
  <br>Test Type:
  <label>
    <?php if(isset($eng_lang_test_type)&& $eng_lang_test_type==0) echo 'IELTS'; ?>
    </label>
  <label>
    <?php if(isset($eng_lang_test_type)&& $eng_lang_test_type==1) echo 'TOEFL (Paper)'; ?>
    </label>
  <label>
    <?php if(isset($eng_lang_test_type)&& $eng_lang_test_type==2) echo ' TOEFL (Internet)'; ?>
   <br>Test Score:</label>
  <?php echo $eng_lang_test_score;	?> &emsp;&emsp;Test Date:
  <?php echo $test_date;?>
<?php }?>
   <?php if(isset($eng_lang)&&$eng_lang==3) {?>
  Other English Course 
  -  
  Course Name
  <?php echo $eng_course_name;	
	?> Result
  <?php echo $eng_course_result;	
	?>
  <?php }?>
</p>
<h2 class="title"><strong>7. Scholarship support</strong></h2>
<p><strong>Require a scholarship to undertake studies:&emsp;</strong>
<?php if(isset($scholarship_support1
)&&$scholarship_support1
==0){echo "No";}
if(isset($scholarship_support1)&&$scholarship_support1
==1){echo "Yes";} ?><br/>
</p>
<p><strong>Have been awarded a tuition fee scholarship from another organisation to undertake studies: &emsp;
  </strong>
  <?php if(isset($scholarship_support2)&&$scholarship_support2
==0){echo "No";}
if(isset($scholarship_support2)&&$scholarship_support2==1){echo "Yes";} ?>
  <br />
</p>
<p><strong>Have been awarded   a living allowance scholarship from another organization to undertake studies:&emsp;</strong>
<?php if(isset($scholarship_support3)&&$scholarship_support3=="no"){echo "No";}
if(isset($scholarship_support3)&&$scholarship_support3=="yes"){echo "Yes"; ?>
</p>
<p><strong>Please list details of scholarships awarded below. </strong>&emsp;</p>
<table class="list">
  <tr class="dark">
    <td><strong>Name of scholarship</strong></td>
    <td><strong>Sponsor/<br/>Organisation</strong></td>
    <td><strong>Value per annum (AUS$)</strong></td>
    <td><strong>Duration in total</strong></td>
    <td><strong>Purpose(s) eg. tuition fees, living expenses</strong></td>
    <td><strong>Status (eg. applied, awarded)</strong></td>
  </tr>
  <?php
  foreach ($schol_names as $schol_key => $schol_name)
      {
           ?>
  <tr class="light">
    <td><?php echo $schol_name;	
	?></td>
    <td><?php echo $sponsors[$schol_key];	
	?></td>
    <td><?php echo '$'.$schol_values[$schol_key];	
	?></td>
    <td><?php echo $schol_durations[$schol_key];	
	?></td>
    <td><?php echo $schol_purposes[$schol_key];	
	?></td>
    <td><?php echo $schol_statuses[$schol_key];	
	?></td>
  </tr>
  <?php }?>
  </table>
  <?php } ?>
<h2 class="title"><br /><strong>8. Why do you want to do Research?</strong></h2>
<p><strong>Main reasons of applicant doing research at Murdoch University </strong></p>
<p>
  <textarea name="textfield18" cols="75" rows="5" style="resize:none !important;" disabled="disabled" readonly="readonly" id="textfield"><?php echo $why_research;?></textarea>
</p>
           
			<hr />
        </tr>
        <?php if($eoi_status==NULL){ 
			?>
				
				
        <div>
					
						<form name="groview" action="" method="post">
						<?php echo $errgroreason1; ?><strong>Please state a reason why was the selection done </strong><small>100 characters max</small><?php echo $errgroreason2; ?><br>
						<textarea name="groreason" type="text" id="textarea" rows="3" cols="75" maxlength="100"></textarea>
						
						&emsp;&emsp;&emsp;&emsp;
						<br><br>
						
						<input type="submit" name="approve" value="Approve"  class="btn1"/>
						
						&emsp;&emsp;
						
						<input type="submit" name="pending" value="Pending" class="btn1"/> 
						
						&emsp;&emsp;
						
						<input type="submit" name="reject" value="Reject" class="btn1" /> 
					
						</form>
				<?php 	} ?>
				
				<?php if($eoi_status!=NULL){ ?>
				
				<strong>Reason for GRO selection. </strong><br>
						 <textarea name="groreason_entered" cols="75" rows="5" style="resize:none !important;" disabled="disabled" readonly="readonly" id="textfield"><?php echo $groreason;?></textarea><br/>
					
						<input type="submit" name="return" onClick="location.href='GRO_ListOfEOI.php'" value="Return To List Of EOI" class="btn1"/>
        </div>
				<?php } ?> </div>
 </div>
    <?php
	include ("footer.php");
	?>
</body>
</html>
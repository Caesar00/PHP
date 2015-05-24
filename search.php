<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search for EOI</title>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>

<?php 
session_start();
include 'connection.php';


if(!isset($_SESSION['staff_id']))
{
	header("Location: staff_login.php?page=search.php");//force to login first
}
if(isset($_SESSION['staff_id'])&&$_SESSION['status']!="GRO")
{
	header("Location: 403error.php");//for non GRO accessing
}
$staff_id=$_SESSION['staff_id'];
$get_user = "SELECT * FROM staff_account WHERE S_No= '$staff_id'";
$get_user_res = mysqli_query($con,$get_user) or die(mysqli_error($con));
while($user = mysqli_fetch_array( $get_user_res )) 
{
	$title=$user['salutation'];
	$firstname=$user['firstname'];
	$lastname=$user['surname'];
}
$fullname = $title." ".$firstname." ".$lastname; // show supervisor full name at top right with welcome message
?>
<body>
	
    <div> 
    <?php
	include "header.php";
	include "GROnav.php";
	?>
	</div>
    <div class="container1" align="center">
				<table align="center" width="100%">
				<!--table for header and footer and ensure alignment-->
					<tr align="center">
						<td>
						<div>
						<h1 align="center" class="title">Search<hr/></h1> </div>
						
							<table width="60%" align='center' class="text">
						<form id="search" name="searchform" method="post"  action="">
						<tr>
							<td colspan="2">
								<p color="#FF0000"><?php echo (isset($errresult) ? $errresult : ""); ?> </p>
							</td>
						</tr>
							<tr>
								<td style="width:25%;" ><strong>EOI Number</strong></td>
								<td style="width:75%;" ><label>
									<input style="width:100%;" type="text" name="txteoi" id="textfield" value="<?php if(isset($_POST['btnsearch'])) echo $_POST['txteoi']; ?>"/>
								</label></td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><strong>Name</strong></td>
								<td><input style="width:100%;" type="text" name="txtname" id="textfield2" value="<?php if(isset($_POST['btnsearch'])) echo $_POST['txtname']; ?>" /></td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><strong>Status</strong></td>
								<td><label>
									<input type="checkbox" name="statuseoi1" id="checkbox" value="PENDING" <?php if(isset($_POST['btnsearch'])&& isset($_POST['statuseoi1'] ) ? $_POST['statuseoi1'] : "" !='') echo 'checked'; ?>/>
									Pending </label><label>
									<input type="checkbox" name="statuseoi2" id="checkbox" value="APPROVED" <?php if(isset($_POST['btnsearch'])&& isset($_POST['statuseoi2'] ) ? $_POST['statuseoi2'] : "" !='') echo 'checked'; ?> />
									Approve</label><label>
									<input type="checkbox" name="statuseoi3" id="checkbox" value="REJECTED" <?php if(isset($_POST['btnsearch'])&& isset($_POST['statuseoi3'] ) ? $_POST['statuseoi3'] : "" !='') echo 'checked'; ?> />
									Rejected </label><label>
									<input type="checkbox" name="statuseoi4" id="checkbox" value="NULL" <?php if(isset($_POST['btnsearch'])&& isset($_POST['statuseoi4'] ) ? $_POST['statuseoi4'] : "" !='') echo 'checked'; ?> />
									Unviewed</label>
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><strong>Citizenship</strong></td>
								<td><label>
									<select name="selectcitizen" style="width:100%;" id="select">
										<option></option>
										<option>Domestic</option>
										<?php 
										$searchcountry = mysqli_query($con,"SELECT * FROM country ") or die(mysqli_error($con));
										//query to get record
										while($searchcountryrow = mysqli_fetch_array( $searchcountry )) 
										{ 
											echo "<option value='".$searchcountryrow['citizenship']."'";
											if(isset($_POST['btnsearch'])&&($searchcountryrow['citizenship']==$_POST['selectcitizen'])){echo 'selected';}
											echo ">".$searchcountryrow['country']."</option>";
										}
										?>
									</select>
								</label></td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><strong>Murdoch Student ID</strong></td>
								<td><input type="text" name="txtmu"style="width:100%;" id="textfield3" value="<?php if(isset($_POST['btnsearch'])) echo $_POST['txtmu']; ?>" /></td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><strong>Email</strong></td>
								<td><input type="text" name="txtemail" style="width:100%;" id="textfield4" value="<?php if(isset($_POST['btnsearch'])) echo $_POST['txtemail']; ?>" /></td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><strong>Telephone Number</strong></td>
								<td><input type="text" name="txttelp" style="width:100%;" id="textfield5" value="<?php if(isset($_POST['btnsearch'])) echo $_POST['txttelp']; ?>" /></td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><strong>Proposed Program</strong></td>
								<td>
									<table><tr><td><label>
									<input type="checkbox" name="checkphd" id="checkbox" value="PhD" <?php if(isset($_POST['btnsearch'])&&isset($_POST['checkphd'])) echo 'checked'; ?>/>
									PhD </label></td><td><label>
									<input type="checkbox" name="checkmphil" id="checkbox" value="MPhil" <?php if(isset($_POST['btnsearch'])&&isset($_POST['checkmphil'])) echo 'checked'; ?>/>
									MPhil</label></td><td><label>
									<input type="checkbox" name="checkdit" id="checkbox" value="DIT" <?php if(isset($_POST['btnsearch'])&&isset($_POST['checkdit'])) echo 'checked'; ?> />
									DIT </label></td><td><label>
									<input type="checkbox" name="checkmed" id="checkbox" value="MEd Res" <?php if(isset($_POST['btnsearch'])&&isset($_POST['checkmed'])) echo 'checked'; ?> />
									MEd Res</label></td><td><label>
									<input type="checkbox" name="checkvet" id="checkbox" value="DVetMedS" <?php if(isset($_POST['btnsearch'])&&isset($_POST['checkvet'])) echo 'checked'; ?> />
									DVetMedSc</label></td></tr><tr><td><label>
									<input type="checkbox" name="checkllm" id="checkbox" value="LLM" <?php if(isset($_POST['btnsearch'])&&isset($_POST['checkllm'])) echo 'checked'; ?> />
									LLM</label></td><td><label>
									<input type="checkbox" name="checkedd" id="checkbox" value="EdD" <?php if(isset($_POST['btnsearch'])&&isset($_POST['checkedd'])) echo 'checked'; ?> />
									EdD</label></td><td><label>
									<input type="checkbox" name="checkrmt" id="checkbox" value="RMT" <?php if(isset($_POST['btnsearch'])&&isset($_POST['checkrmt'])) echo 'checked'; ?> />
									RMT</label></td><td><label>
									<input type="checkbox" name="checkpsy" id="checkbox" value="DPSYCH" <?php if(isset($_POST['btnsearch'])&&isset($_POST['checkpsy'])) echo 'checked'; ?> />
									DPSYCH</label></td><td><label>
									<input type="checkbox" name="checkmap" id="checkbox" value="MAppPsych/PhD" <?php if(isset($_POST['btnsearch'])&&isset($_POST['checkmap'])) echo 'checked'; ?> />
									MAppPsych/PhD</label></td></tr></table>
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><strong>School Name</strong></td>
								<td>
									<select name="txtschool" id="school" style="width:100%;" >
										<option selected value=""></option>
										<?php 
										$searchschool = mysqli_query($con,"SELECT * FROM school") or die(mysqli_error($con));
										//query to get record
										while($searchschool_res = mysqli_fetch_array( $searchschool )) 
										{ 
											echo "<option value='".$searchschool_res['Sc_NO']."' ";
											if(isset($_POST['btnsearch'])&&($searchschool_res['Sc_NO']==$_POST['txtschool'])){echo 'selected ';}
											echo ">".$searchschool_res['name']."</option>";
										}
										?>
									</select>
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><strong>Full/Part Time</strong></td>
								<td>
									<label><input type="checkbox" name="fulltime" id="checkbox" value="f" <?php if(isset($_POST['btnsearch'])&& isset($_POST['fulltime'] ) ? $_POST['fulltime'] : "" =='f') echo 'checked'; ?> />
									Full Time</label>
									<label><input type="checkbox" name="parttime" id="checkbox" value="p" <?php if(isset($_POST['btnsearch'])&& isset($_POST['parttime'] ) ? $_POST['parttime'] : "" =='p') echo 'checked'; ?> />
									Part Time</label>
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td><strong>Supervisor Name</strong></td>
								<td><input type="text" name="txtsup" style="width:100%;" id="textfield7" value="<?php if(isset($_POST['btnsearch'])) echo $_POST['txtsup']; ?>" /></td>
							</tr>
							<tr>
								<td align="center" colspan="2"><br>
								<input type="submit" name="btnsearch" class="btn1" id="button" value="Search"  /></td>
							</tr></form>
						</table>
					
<br><br>
						<?php
						$err ="";
						$errresult="";
						if(isset($_POST['btnsearch']))
						{							
							if((isset($_POST['txteoi'] ) ? $_POST['txteoi'] : "" ) =="" && (isset($_POST['txtname'] ) ? $_POST['txtname'] : "" ) == "" && (isset($_POST['statuseoi1'] ) ? $_POST['statuseoi1'] : "") == "" && (isset($_POST['statuseoi2'] ) ? $_POST['statuseoi2'] : "") == "" && (isset($_POST['statuseoi3'] ) ? $_POST['statuseoi3'] : "") == "" && (isset($_POST['statuseoi4'] ) ? $_POST['statuseoi4'] : "") == "" && (isset($_POST['selectcitizen'] ) ? $_POST['selectcitizen'] : "") == "" && (isset($_POST['txtmu'] ) ? $_POST['txtmu'] : "") == "" && (isset($_POST['txtemail'] ) ? $_POST['txtemail'] : "") == "" && (isset($_POST['txttelp'] ) ? $_POST['txttelp'] : "") == "" && (isset($_POST['checkphd'] ) ? $_POST['checkphd'] : "") == "" && (isset($_POST['checkmphil'] ) ? $_POST['checkmphil'] : "") == "" && (isset($_POST['checkdit'] ) ? $_POST['checkdit'] : "") == "" && (isset($_POST['checkmed'] ) ? $_POST['checkmed'] : "") == "" && (isset($_POST['checkvet'] ) ? $_POST['checkvet'] : "") == "" && (isset($_POST['checkllm'] ) ? $_POST['checkllm'] : "") == "" && (isset($_POST['checkedd'] ) ? $_POST['checkedd'] : "") == "" && (isset($_POST['checkrmt'] ) ? $_POST['checkrmt'] : "") == "" && (isset($_POST['checkpsy'] ) ? $_POST['checkpsy'] : "") == "" && (isset($_POST['checkmap'] ) ? $_POST['checkmap'] : "") == "" && (isset($_POST['txtschool'] ) ? $_POST['txtschool'] : "") == "" && (isset($_POST['fulltime'] ) ? $_POST['fulltime'] : "") == "" && (isset($_POST['parttime'] ) ? $_POST['parttime'] : "") == "" && (isset($_POST['txtsup'] ) ? $_POST['txtsup'] : "") == "")
							{
								$err ="Yes";
							}
							
							
							
							$search = "SELECT *,eoi.eoi_no AS eoi_ID FROM eoi LEFT JOIN applicant AS app ON eoi.app_no=app.app_no LEFT JOIN eoi_academic AS acad ON eoi.eoi_no=acad.eoi_no WHERE ";
							
							/* add the required SQL query code depending on the selection/inputs*/
							
							/*			select by eoi number			*/
							if ((isset($_POST['txteoi'] ) ? $_POST['txteoi'] : "") != "") 
							{	
								$txteoi=mysqli_real_escape_string($con,trim($_POST['txteoi']));
								$search .= "eoi.eoi_no LIKE '%$txteoi%' AND ";
							}
							/*			select by entered name		*/
							if ((isset($_POST['txtname'] ) ? $_POST['txtname'] : "") != "") 
							{	
								$txtname=mysqli_real_escape_string($con,trim($_POST['txtname']));
								$search .= "CONCAT(app.firstname, ' ', app.surname) LIKE '%$txtname%' AND ";
							}
							
							//////////////////////////////////////////////
							
							if ((isset($_POST['statuseoi1'])? $_POST['statuseoi1'] : "") != "" || (isset($_POST['statuseoi2'] ) ? $_POST['statuseoi2'] : "") != "" || (isset($_POST['statuseoi3'] ) ? $_POST['statuseoi3'] : "") != "" || (isset($_POST['statuseoi4'] ) ? $_POST['statuseoi4'] : "") != "") 
							{	
								$statuseoi1=mysqli_real_escape_string($con,trim((isset($_POST['statuseoi1'] ) ? $_POST['statuseoi1'] : "" ) ));
                                                                $statuseoi2=mysqli_real_escape_string($con,trim((isset($_POST['statuseoi2'] ) ? $_POST['statuseoi2'] : "" ) ));
                                                                $statuseoi3=mysqli_real_escape_string($con,trim((isset($_POST['statuseoi3'] ) ? $_POST['statuseoi3'] : "" ) ));
                                                                $statuseoi4=mysqli_real_escape_string($con,trim((isset($_POST['statuseoi4'] ) ? $_POST['statuseoi4'] : "" ) ));
								$search .= "(status = '$statuseoi1' OR status = '$statuseoi2' OR status = '$statuseoi3' OR status = '$statuseoi4') AND ";	
							}
							
							
							/*			select by country			*/
							if ((isset($_POST['selectcitizen'] ) ? $_POST['selectcitizen'] : "") != "") 
							{	
								$selectcitizen=mysqli_real_escape_string($con,trim($_POST['selectcitizen']));
								$search .= "citizenship = '$selectcitizen' AND ";
							}
							/*			select by past murdoch id			*/
							if ((isset($_POST['txtmu'] ) ? $_POST['txtmu'] : "") != "") 
							{	
								$txtmu=mysqli_real_escape_string($con,trim($_POST['txtmu']));
								$search .= "mu_id = '$txtmu' AND ";
							}
							/*			select by email			*/
							if ((isset($_POST['txtemail'] ) ? $_POST['txtemail'] : "" ) != "") 
							{	
								$txtemail=mysqli_real_escape_string($con,trim($_POST['txtemail']));
								$search .= "app.email = '$txtemail' AND ";
							}
							/*			select by telephone			*/
							if ((isset($_POST['txttelp'] ) ? $_POST['txttelp'] : "" ) != "") 
							{	
								$txttelp=mysqli_real_escape_string($con,trim($_POST['txttelp']));
								$search .= "telephone = '$txttelp' AND ";
							}
							/*			select by program			*/
							if ((isset($_POST['checkphd'] ) ? $_POST['checkphd'] : "" ) != "") 
							{	
								$checkphd=mysqli_real_escape_string($con,trim($_POST['checkphd']));
								$search .= "proposed_program LIKE '$checkphd%' AND ";
							}
							if ((isset($_POST['checkmphil'] ) ? $_POST['checkmphil'] : "" ) != "") 
							{	
								$checkmphil=mysqli_real_escape_string($con,trim($_POST['checkmphil']));
								$search .= "proposed_program LIKE '%$checkmphil%' AND ";
							}
							if ((isset($_POST['checkdit'] ) ? $_POST['checkdit'] : "" ) != "") 
							{	
								$checkdit=mysqli_real_escape_string($con,trim($_POST['checkdit']));
								$search .= "proposed_program LIKE '%$checkdit%' AND ";
							}
							if ((isset($_POST['checkmed'] ) ? $_POST['checkmed'] : "" ) != "") 
							{	
								$checkmed=mysqli_real_escape_string($con,trim($_POST['checkmed']));
								$search .= "proposed_program LIKE '%$checkmed%' AND ";
							}	
							if ((isset($_POST['checkvet'] ) ? $_POST['checkvet'] : "" ) != "") 
							{	
								$checkvet=mysqli_real_escape_string($con,trim($_POST['checkvet']));
								$search .= "proposed_program LIKE '%$checkvet%' AND ";
							}	
							if ((isset($_POST['checkllm'] ) ? $_POST['checkllm'] : "" ) != "") 
							{		
								$checkllm=mysqli_real_escape_string($con,trim($_POST['checkllm']));
								$search .= "proposed_program LIKE '%$checkllm%' AND ";
							}
							if ((isset($_POST['checkedd'] ) ? $_POST['checkedd'] : "" ) != "") 
							{	
								$checkedd=mysqli_real_escape_string($con,trim($_POST['checkedd']));
								$search .= "proposed_program LIKE '%$checkedd%' AND ";
							}
							if ((isset($_POST['checkrmt'] ) ? $_POST['checkrmt'] : "" ) != "") 
							{	
								$checkrmt=mysqli_real_escape_string($con,trim($_POST['checkrmt']));
								$search .= "proposed_program LIKE '%$checkrmt%' AND ";
							}
							if ((isset($_POST['checkpsy'] ) ? $_POST['checkpsy'] : "" ) != "") 
							{	
								$checkpsy=mysqli_real_escape_string($con,trim($_POST['checkpsy']));
								$search .= "proposed_program LIKE '%$checkpsy%' AND ";
							}
							if ((isset($_POST['checkmap'] ) ? $_POST['checkmap'] : "" ) != "") 
							{	
								$checkmap=mysqli_real_escape_string($con,trim($_POST['checkmap']));
								$search .= "proposed_program LIKE '%$checkmap' AND ";
							}
							/*---------------marks end of program selection----------------*/
							/*					search by school				*/
							if ((isset($_POST['txtschool'] ) ? $_POST['txtschool'] : "" ) != "")
							{
								$txtschool=mysqli_real_escape_string($con,trim($_POST['txtschool']));
								$search .= "eoi.Sc_No ='$txtschool' AND ";
							}
							/*			select by full and/or part time			*/
							if ((isset($_POST['fulltime'] ) ? $_POST['fulltime'] : "" ) != "" && (isset($_POST['parttime'] ) ? $_POST['parttime'] : "" ) != "")
							{
								$fulltime=mysqli_real_escape_string($con,trim($_POST['fulltime']));
								$parttime=mysqli_real_escape_string($con,trim($_POST['parttime']));
								$search .= "time_candidate = '$fulltime' OR time_candidate = '$parttime' AND ";
							}
							if ((isset($_POST['fulltime'] ) ? $_POST['fulltime'] : "" ) != "" && (isset($_POST['parttime'] ) ? $_POST['parttime'] : "" ) == "") 
							{	
							
								$fulltime=mysqli_real_escape_string($con,trim(isset($_POST['fulltime'] ) ? $_POST['fulltime'] : "" ));
								$search .= "time_candidate = '$fulltime' AND ";	
							}
							if ((isset($_POST['parttime'] ) ? $_POST['parttime'] : "" ) != "" && (isset($_POST['fulltime'] ) ? $_POST['fulltime'] : "" ) == "") 
							{	
								$parttime=mysqli_real_escape_string($con,trim(isset($_POST['parttime'] ) ? $_POST['parttime'] : "" ));
								$search .= "time_candidate = '$parttime' AND ";	
							}
							/*			select by firstname or lastname	of referal supervisor	*/
							if ((isset($_POST['txtsup'] ) ? $_POST['txtsup'] : "" ) != "") 
							{	
								$txtsup=mysqli_real_escape_string($con,trim($_POST['txtsup']));
								$search .= "eoi_academic.name LIKE '%$txtsup%' AND ";
							}
							
							//marks the end of the query
							$search .= "eoi.eoi_no IS NOT NULL GROUP BY eoi.eoi_no ORDER BY eoi.eoi_no ";
							//echo $search."<br><br><br>"; // used to see the query that is entered into the database
							if($err =="")
							{
								
								$search_res = mysqli_query($con,$search) or die(mysqli_error($con));
								$search_row = mysqli_num_rows($search_res);
								echo "<fieldset>";
								echo "<table align='center'>";
								echo "<tr style='border-bottom-style:double;'><td><strong>EOI Number</strong></td><td><strong>Full Name</strong></td><td align='right'>".$search_row." result(s) found</td></tr>";
								if($search_row ==0)
								{
									echo "<tr><td align='center' colspan='3'>No Results Found</td></tr>";
								}
								
								while ($result = mysqli_fetch_array($search_res)) 
								{
									$eoi = $result['eoi_ID'];
									$firstname = $result['firstname'];
									$lastname = $result['surname'];
									
									echo '<tr>';
									echo '<td width="200" >'.$eoi.'</td>';
									echo '<td width="200">'.$firstname.' '.$lastname.'</td>';
									echo '<td width="200" align="right" >';
									echo '<form method="post" action="GRO_ViewEOI.php">';
									echo '<button type="submit" style="height:auto;" onClick="submit_btn(this)" class="btn1" name="eoi_id" value="'.$eoi.'" >View Details</button>';
									echo '</form>';
									echo '</td>';
									echo '</tr>';
								}
								echo "</table>";
								echo "</fieldset>";
							}
						}
						?>
        
<!----------------------------------------------------------------->
						&nbsp;
						</td>
					</tr>
					<tr>
						<td>
							
						</td>
				  </tr>
				</table>
                </div>
                <?php
							include ("footer.php");
							?>
<p>&nbsp;  </p>
<?php //coding is credited by Chen Jia Wei & Wong Hui Bing ?>
</body>
</html>


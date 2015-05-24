<html>
<title>Report Generator</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<link rel="stylesheet" href="/resources/demos/style.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script language="javascript" type="text/javascript">
//datepicker
$(document).ready(function() {
	$( "#todatesup" ).datepicker
	({
		maxDate: new Date(),
		defaultDate: new Date(),
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
	});
});
$(document).ready(function() {
	$( "#fromdatesup" ).datepicker
	({
		maxDate: new Date(),
		defaultDate: new Date(),
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
	});
});
$(document).ready(function() {
	$( "#todatefor" ).datepicker
	({
		maxDate: new Date(),
		defaultDate: new Date(),
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
	});
});
$(document).ready(function() {
	$( "#fromdatefor" ).datepicker
	({
		maxDate: new Date(),
		defaultDate: new Date(),
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
	});
});
$(document).ready(function() {
	$( "#todatecommence" ).datepicker
	({
		maxDate: new Date(),
		defaultDate: new Date(),
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
	});
});
$(document).ready(function() {
	$( "#fromdatecommence" ).datepicker
	({
		maxDate: new Date(),
		defaultDate: new Date(),
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
	});
});


function addSubject( el ){
    var newValu = el.value,
        kiddies = document.getElementById("reportgen").childNodes,
        klength = kiddies.length, curNode;
    while ( klength-- ) {
      curNode = kiddies[klength];
      if( curNode.nodeName == "DIV" )
        curNode.style.display = curNode.id == newValu ? "block" : "none" ;
    }
}
</script>
<?php
session_start();
include "connection.php";

if(!isset($_SESSION['staff_id']))
{
	header("Location: staff_login.php?page=reportgenerator.php");
}//force to login first
if(isset($_SESSION['staff_id'])&&($_SESSION['status']!="GRO"&&$_SESSION['status']!="Sup"))
{
	header("Location: 403error.php");//for non GRO accessing
}
$staff_id=$_SESSION['staff_id'];
$get_user = "SELECT * FROM staff_account WHERE S_no = '$staff_id'";
$get_user_res = mysqli_query($con,$get_user) or die(mysqli_error($con));
while($user = mysqli_fetch_array( $get_user_res )) 
{
	$title=$user['salutation'];
	$firstname=$user['firstname'];
	$lastname=$user['surname'];
}
$fullname = $title." ".$firstname." ".$lastname; // show supervisor full name at top right with welcome message

$eoi_id = isset($_POST['eoi_id'] ) ? $_POST['eoi_id'] : "" ;	
?>

<body>
                    <div>
			<?php include "header.php";
                        if($_SESSION['status']=="GRO")
                            include "GROnav.php";
                        else
                            include "Staffnav.php";
                        ?>
			</div>
				<table border="0" align="center" width="100%">
				<!--table for header and footer and ensure alignment-->
					<tr>
						<td style="padding:27px 40px;" ><div id="content3title" >
							<h1 align="center">Report Generator<hr /></h1>
							</div>
						<br /> 
							<form id="search" name="searchform" method="post"  action="ViewReport.php" target="_blank">
							<table border="0" align="center">
								<tr>
									<td align="right">
										<div align="left"> <strong>View: &emsp;</strong> <select id='reporting' name='reporting'  onclick="addSubject(this)">
											<option value="">-- Please Select --</option>
											<option value="school" <?php if(isset($_POST['btnreport']) && $_POST['reporting'] == 'school'){ echo 'selected';} ?> >School Ranking (Based on EOI)</option>
											<option value="for" <?php if(isset($_POST['btnreport']) && $_POST['reporting'] == 'for'){ echo 'selected';} ?> >Field of Research (Based on  EOI)</option>
											<option value="month" <?php if(isset($_POST['btnreport']) && $_POST['reporting'] == 'month'){ echo 'selected';} ?> >Commencing Period (Based on  EOI)</option>
											<option id="sup_prorata" value='sup_prorata'<?php if(isset($_POST['btnreport']) && $_POST['reporting'] == 'sup_prorata'){ echo 'selected';} ?> >Supervisor Prorata</option>
										</select>
										<br> &nbsp;</div>
										<div align="left">
											
										</div></td>
								</tr>
								
								<tr>
									<td>
										<div id="reportgen">
											<div class="box" id="school" <?php if(!isset($_POST['btnreport']) || !isset($_POST['reporting']) ||(isset($_POST['btnreport']) && $_POST['reporting']!="school")) {echo " style='display: none;'";}?>>
												<table border="0" >
													<tr>
														<td align='left'><strong>Expression of Interest Date Submitted &emsp;&nbsp;&nbsp;&nbsp;</strong></td></tr>
														<tr><td><strong> From : &nbsp;</strong>
														<input type="text" id="fromdatesup" name="fromdatesup" value="<?php if(isset($_POST['fromdatesup']))echo $_POST['fromdatesup'] ?>" />&emsp;
														<strong>To : &nbsp;</strong>
														<input type="text" id="todatesup" name="todatesup" value="<?php if(isset($_POST['todatesup']))echo $_POST['todatesup'] ?>" /> 
														</td>
													</tr>
												</table>
											</div>
											<div class="box" id="for" <?php if(!isset($_POST['btnreport']) || !isset($_POST['reporting']) ||(isset($_POST['btnreport']) && $_POST['reporting']!="for")) {echo "style='display: none;'";}?>>
												<table>
													<tr>
														<td><strong>Expression of Interest Date Submitted </strong></td>
													</tr>
													<tr>
														<td><strong>From : &nbsp;</strong>
														<input type="text" id="fromdatefor" name="fromdatefor" value="<?php if(isset($_POST['fromdatefor']))echo $_POST['fromdatefor'] ?>" />&emsp;
														<strong>To : &nbsp;</strong>
														<input type="text" id="todatefor" name="todatefor" value="<?php if(isset($_POST['todatefor']))echo $_POST['todatefor'] ?>" /></td>
													</tr>
												</table>
											</div>
											<div class="box" id="month" <?php if(!isset($_POST['btnreport']) || !isset($_POST['reporting']) ||(isset($_POST['btnreport']) && $_POST['reporting']!="month")) {echo "style='display: none;'";}?>>
												<div>
													<table>
													<tr>
														<td><strong>Expression of Interest Date Submitted &emsp;&nbsp;&nbsp;&nbsp;</strong></td></tr><tr><td>
														<strong>From : &nbsp;</strong>
														<input type="text" id="fromdatecommence" name="fromdatecommence" value="<?php if(isset($_POST['fromdatecommence']))echo $_POST['fromdatecommence'] ?>" />&emsp;
														<strong>To : &nbsp;</strong>
														<input type="text" id="todatecommence" name="todatecommence" value="<?php if(isset($_POST['todatecommence']))echo $_POST['todatecommence'] ?>" />
														</td>
													</tr>
													<tr>
													<td>&emsp;</td>
													</tr>
													<tr>
														<td><strong>Sorted By: &emsp;&emsp;
														<label><input type="radio" name="commence" id="radio" value="month" <?php if(isset($_POST['btnsearch'])&&$_POST['commence']=='month') echo 'checked'; ?> />Month</label>&emsp;&emsp;
														<label><input type="radio" name="commence" id="radio" value="year" <?php if((isset($_POST['btnsearch'])&&$_POST['commence']=='year')||!isset($_POST['btnsearch'])) {echo 'checked';} ?> />Year</label></strong>
														</td>
													</tr>
													</table>
												</div>
											</div>
											<div class="box" id="sup_prorata" <?php if(!isset($_POST['btnreport']) || !isset($_POST['reporting']) ||(isset($_POST['btnreport']) && $_POST['reporting']!="sup_prorata")) {echo "style='display: none;'";}?>>
												<div>
													<table>
													<tr>
														<td>
														<strong>Sorted By: &emsp;&emsp;
														<label><input type="radio" name="sortprorata" id="radio" value="school" <?php if((isset($_POST['btnsearch'])&&$_POST['sortprorata']=='school')||!isset($_POST['btnsearch'])) echo 'checked'; ?> />School</label>&emsp;&emsp;
														<label><input type="radio" name="sortprorata" id="radio" value="name" <?php if(isset($_POST['btnsearch'])&&$_POST['sortprorata']=='name') echo 'checked'; ?> />Staff</label>&emsp;&emsp;
														<label><input type="radio" name="sortprorata" id="radio" value="prorata" <?php if(isset($_POST['btnsearch'])&&$_POST['sortprorata']=='prorata') {echo 'checked';} ?> />Highest Prorata First</label></strong>
														</td>
													</tr>
													</table>
												</div>
											</div>
										</div>
									</td>
								</tr>
								<tr><td>&emsp;</td></tr>
								<tr>
									<td align="center"><br><br><br>
										<div align="center">
											<input type="submit" name="btnreport" id="button" value="Generate"  class="btn1" div class />
											
										</div>
									</td>
								</tr>
							</table>
							</form>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<?php
							include ("footer.php");
							?>
						</td>
				  </tr>
				</table>
		</td>
	</tr>
</table>
<p>&nbsp;  </p>
<?php //coding is credited by Chen Jia Wei & Wong Hui Bing ?>
</body>
</html>


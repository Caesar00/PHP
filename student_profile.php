<div class="leftmenu">
  <div class="box">
  <a <?php if(!isset($_GET['act']))echo("class='selected'");?> href="student_index.php">Personal Details</a>
  <div class="line"></div> 
  <a <?php if(isset($_GET['act'])&&$_GET['act']=='update')echo("class='selected'");?> href="student_index.php?act=update">Update Personal Details</a>
  <div class="line"></div>
  <a <?php if(isset($_GET['act'])&&$_GET['act']=='password')echo("class='selected'");?> href="student_index.php?act=password">Change Password</a> </div>
</div>
<div style="float:right; width:80%;">
  <?php
  if(isset($_GET['act']))
  {
	  
	  if($_GET['act']=="update")
	  {
		  include "student_update_detail.php";
	  }
	  if($_GET['act']=="password")
	  {
		  include "student_update_password.php";
	  }
  }
  else
  {
	  include "student_profile_detail.php";
  }
  ?>
</div>

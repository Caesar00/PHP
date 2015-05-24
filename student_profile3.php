  <?php
  if(isset($_GET['act']))
  {
	  if($_GET['act']=="update")
	  {
		  include "student_update_detail3.php";
	  }
	  if($_GET['act']=="password")
	  {
		  include "student_update_password3.php";
	  }
  }
  else
  {
	  include "student_home.php";
  }
  ?>

<?php
include "library.php";
session_start();
if(isset($_SESSION['apr_a']))
{
	if(isset($_SESSION['apr_a']['status'])&&$_SESSION['apr_a']['status']!='supervisor rejected')
	{
		unset($_SESSION['apr_a']);
		unset($apr_a);
		if(isset($_SESSION['apr_d_a']))
		{
			unset($_SESSION['apr_d_a']);
			unset($apr_d_a);
		}
		if(isset($_SESSION['apr_d_b']))
		{
			unset($_SESSION['apr_d_b']);
			unset($apr_d_b);
		}
	}
}
session_commit();
?>
<div class="container2">
  <div class="title">Submit New APR</div>
  <div class="content">
  <?php
  if(isset($_GET['page']))
  {
	  switch($_GET['page'])
	  {
		  case 2:
		  include "apr_detail_2.php";
		  break;
		  case 3:
		  include "apr_detail_3.php";
		  break;
		  case 4:
		  include "apr_detail_4.php";
		  break;
		  case 5:
		  include "apr_detail_5.php";
		  break;
		  case 6:
		  include "apr_detail_6.php";
		  break;
		  case 7:
		  include "confirm_submission.php";
		  break;
	  }
  }
  else
  {
	  include "apr_detail_1.php";
  }
  ?>
  </div>
</div>

<div class="leftmenu">
  <div class="box"> 
  <a <?php if(!isset($_GET['act']))echo("class='selected'");?> href="student_index.php?cont=APR">List of APRs</a>
  <div class="line"></div>
  <a <?php if(isset($_GET['act'])&&$_GET['act']=='submit')echo("class='selected'");?> href="student_index.php?cont=APR&act=submit">Submit New APR</a> </div>
</div>
<div style="float:right; width:80%;">
  
    <?php
  if(isset($_GET['act']))
  {
	  if($_GET['act']=="submit")
	  {
		  include "student_submit_apr.php";
	  }
	  if($_GET['act']=="view")
	  {
		  include "student_view_apr.php";
	  }
  }
  else
  {
	  include "student_apr_list.php";
  }
  ?>

</div>
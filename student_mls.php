<div class="leftmenu">
    <div class="box">
        <a <?php if(!isset($_GET['act']))echo("class='selected'");?> href="student_index.php?cont=MLS">
            View Existing Meeting Logs
        </a>
        <div class="line"></div>
        <a <?php if(isset($_GET['act'])&&$_GET['act']=='submit')echo("class='selected'");?> href="student_index.php?cont=MLS&act=submit">
            Create a New Meeting Log
        </a>
    </div>
</div>
<div style="float:right; width:80%;">
  
    <?php
  if(isset($_GET['act']))
  {
	  if($_GET['act']=="submit")
	  {
		  include "student_submit_mls.php";
	  }
	  if($_GET['act']=="view")
	  {
		  include "student_view_mls.php";
	  }
  }
  else
  {
	  include "student_mls_list.php";
  }
  ?>

</div>

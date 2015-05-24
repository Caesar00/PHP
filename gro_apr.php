<div class="leftmenu">
  <div class="box"> 
  <a <?php if(!isset($_GET['act']))echo("class='selected'");?> href="gro_index.php?cont=APR">List of APRs</a>
  <div class="line"></div>
  <a <?php if(isset($_GET['act'])&&$_GET['act']=='submit')echo("class='selected'");?> href="gro_index.php?cont=APR&act=report">Generate APR reports</a> </div>
</div>
<div style="float:right; width:80%;">
  
    <?php
  if(isset($_GET['act']))
  {
	  if($_GET['act']=="report")
	  {
		  include "gro_apr_report.php";
	  }
	  if($_GET['act']=="view")
	  {
		  include "gro_view_apr.php";
	  }
  }
  else
  {
	  include "gro_apr_list.php";
  }
  ?>

</div>
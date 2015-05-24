<?php
include "library.php";
?>
<div class="container2">
  <div class="title">Submit Section C APR</div>
  <div class="content">
  <?php
  if(isset($_GET['page']))
  {
	  switch($_GET['page'])
	  {
		  case 2:
		  include "view_apr_b.php";
		  ?>
  <div class="formflow_h" style="width:80%">
    <p class="buttons"><a href="dean_APR.php?cont=APR&act=submit">< Section A</a><a href="dean_APR.php?cont=APR&act=submit&page=3">Section b ></a></p></div>
    <?php
		  break;
		  case 3:
		  include "dean_APR_C.php";
		  ?>
  <br/>
  <div class="formflow_h" style="width:80%">
    <p class="buttons"><a href="dean_APR.php?cont=APR&act=submit&page=1">< Section B</a></p></div>
    <?php
		  break;
		  case 4:
		  include "APR_C_submit.php";
		  break;
	  }
  }
  else
  {
	  include "View_APR_A.php";
	  ?>
    <div class="formflow_h" style="width:80%">
      <p class="buttons"><a href="dean_APR.php?cont=APR&act=submit&page=2">Section B ></a></p>
      </div>
      <?php
  }
  ?>
  </div>
</div>

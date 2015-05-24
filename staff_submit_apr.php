<?php
include "library.php";
?>

<div class="container2">
  <div class="title">Submit Section B APR</div>
  <div class="content">
    <?php
  if(isset($_GET['page']))
  {
	  switch($_GET['page'])
	  {
		  case 2:
		  include "APR_B.php";
		  ?>
    <div class="formflow_h" style="width:80%">
      <p class="buttons"><a href="staff_APR.php?cont=APR&act=submit">< Section A</a></p>
    </div>
    <?php
		  break;
		  case 3:
		  include "APR_B_2.php";
		  ?>
    <div class="formflow_h" style="width:80%">
      <p class="buttons"><a href="staff_APR.php?cont=APR&act=submit">< Section A</a></p>
    </div>
    <?php
		  break;
		  case 4:
		  include "APR_B_submit.php";
		  break;
		  case 5:
		  include "APR_B_reject.php";
		  break;
	  }
  }
  else
  {
	  include "View_APR_A.php";
	  ?>
    <div class="formflow_h" style="width:80%">
      <p class="buttons"><a href="staff_APR.php?cont=APR&act=submit&page=2">Section B ></a></p>
    </div>
    <?php
  }
  if(!isset($_GET['page']) || $_GET['page']<4)
  {
	  ?>
    <br />
    <div class="formflow_h" style="width:80%">
      <p class="buttons"><a href="staff_APR.php?cont=APR&act=submit&page=5">Reject this APR</a></p>
    </div>
    <?php
  }
  ?>
  </div>
</div>

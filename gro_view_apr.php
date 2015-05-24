<?php
include "library.php";
?>
<script  language="javascript" type='text/javascript'>
$(document).ready(function() {
	$("input:text").each(function(){
		$(this).attr("disabled","disabled");
	});
	$("input:radio").each(function(){
		$(this).attr("disabled","disabled");
	});
	$("input:checkbox").each(function(){
		$(this).attr("disabled","disabled");
	});
	$("textarea").each(function(){
		$(this).attr("disabled","disabled");
	});
	$("select").each(function(){
		$(this).attr("disabled","disabled");
	});
});
</script>

<div class="container2">
<div class="title">View APR</div>
<div id="view" class="content">
  <?php
  if(isset($_GET['page']))
  {
	  switch($_GET['page'])
	  {
		  case 2:
		  include "view_apr_b.php";
		  ?>
  <br />
  <div class="formflow_h" style="width:80%">
    <p class="buttons"><a href="gro_index.php?cont=APR&act=view">< Section A</a><?php if(isset($_SESSION['apr_c']))
		  {?>
			  <a href="gro_index.php?cont=APR&act=view&page=3">Section C >
              <?php } ?></a></p>
    <?php
		  break;
		  case 3:
		  include "view_apr_c.php";
		  ?>
  <br />
  <div class="formflow_h" style="width:80%">
    <p class="buttons"><a href="gro_index.php?cont=APR&act=view&page=2">< Section B</a></p>
    <?php
		  break;
	  }
  }
  else
  {
	  include "View_APR_A.php";
	  if(isset($_SESSION['apr_b']))
	  {
	  ?>
    <br />
    <div class="formflow_h" style="width:80%">
      <p class="buttons"><a href="gro_index.php?cont=APR&act=view&page=2">Section B ></a></p>
      <?php
	  }
  }
  ?>
      <br />
      <p class="buttons"><a href="gro_index.php?cont=APR">Go Back to List</a></p>
    </div>
  </div>
</div>

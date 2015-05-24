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
<div class="title">View Meeting Log</div>
<div id="view" class="content">
    <?php include 'view_ml.php'; ?>
    <div class="formflow_h" style="width:80%">
        <p class="buttons"><a href="staff_MLS.php?cont=MLS">Go Back to List</a></p>
    </div>
  </div>
</div>

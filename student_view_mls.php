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
    <div class="content">
    <div class="formflow_h" style="width:80%">
        <?php include "view_ml.php"; ?>
        <br />
        <p class="buttons">
        <?php
        if($_SESSION['ml']['confirmation_status']=='rejected')
            echo "<a href='student_index.php?cont=MLS&act=submit'>Edit and Resubmit</a>";
        ?>
        <a href="student_index.php?cont=MLS">Go Back to List</a></p>
    </div>
</div>

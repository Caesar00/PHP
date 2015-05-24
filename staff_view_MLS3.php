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
<?php include "view_ml3.php"; ?>
</div>

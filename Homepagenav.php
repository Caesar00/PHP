<link href="css/header.css" rel="stylesheet" type="text/css">
<form name="form1" method="post" action="">
<p>
	<input type="submit" name="Home" id="Home" value="Home" style="width:100px;" class="Navbarbtn" />&emsp;
	<input type="submit" name="FAQ" id="FAQ" value="FAQs" style="width:100px;" class="Navbarbtn" />
	<!-- deletion of comment will enable the button -->
	<!--<input type="submit" name="Courses" id="Courses" value="Courses" class="Navbarbtn" />
	<input type="submit" name="Future students" id="Future students" value="Future students" class="Navbarbtn" />
	<input type="submit" name="News" id="News" value="News" class="Navbarbtn" />
	<input type="submit" name="Alumni" id="Alumni" value="Alumni" class="Navbarbtn" />

	<input type="submit" name="New Student " id="New Student " value="New Student " class="Navbarbtn" />-->
</p>
</form>
<?php
if(isset($_POST['Home'])){
header("Location: Login%20Page.php");}

if(isset($_POST['FAQ'])){
header("Location: faq.php");}

//if(isset($_POST['ListofEOI'])){
//header("Location: GRO_ListOfEOI.php");}

//if(isset($_POST['search'])){
//header("Location: search.php");}

?>
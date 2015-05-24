<?php 
session_start();

if($_SESSION['status']!="GRO"){
header( "refresh:3;url=Staff_CurrentStudent.php" );}
if($_SESSION['status']!="Sup"){
header( "refresh:3;url=GRO_ListOfEOI.php" );}
?>

<html>

<body>
<table border="0" align="center" id="form1">
	<tr>
		<td>
			<div id="header"> 
			<div id="logo"></div>
			</div>

				<table border="0" align="center"id="form1">
				<!--table for header and footer and ensure alignment-->
					<tr>
						<td style="padding:5px 40px;">
						&nbsp;
							<h1>HTTP Status 403 - Access is denied</h1>
							<h3>Message : You do not have permission to access this page!</h3>
                                                        <?php
                                                        echo $_SESSION['staff_id']." | ".$_SESSION['status'];
                                                        echo '</br>';
                                                        echo 'Status: ' + (isset($_SESSION['status']) ? $_SESSION['status'] : +'NONE') ;	
                                                        ?>
							
						&nbsp;
						</td>
					</tr>
					<tr>
						<td>
						&nbsp;
						</td>
					</tr>
					<tr>
						<td>
							<?php
							include ("footer.php");
							?>
						</td>
				  </tr>
				</table>
		</td>
	</tr>
</table>
<p>&nbsp;  </p>

</body>
</html>


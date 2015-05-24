<?php 
session_start();

if($_SESSION['status']!="GRO"){
header( "refresh:3;url=Staff_Homepage.php" );}
if($_SESSION['status']!="Sup"){
header( "refresh:3;url=GRO_ListOfEOI.php" );}
?>
<body>
<table border="0" align="center" id="form1">
	<tr>
		<td >
			<div id="header"> 
			<div id="logo"></div>
			</div>

				<table border="0" align="center"id="form1">
				<!--table for header and footer and ensure alignment-->
					<tr>
						<td style="padding:5px 40px;">
					      <h1 align="left"><br>HTTP 404 - File not found&nbsp;
					      </h1>
					      <hr>
					      <h3>The page you are looking for might have been removed or it is temporarily unavailable. </h3>	
							
							<p>&nbsp;</p>
						&nbsp;
						</td>
					</tr>
					<tr>
						<td>&nbsp;
						
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


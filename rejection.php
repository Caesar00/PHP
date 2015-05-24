<html>
<?php session_start(); 
/* this shows the error message when the page goes white
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if ($_SESSION['is_admin'])
{
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}
ini_set('html_errors', 'On');*/
?>
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
							<table>
							<tr align="center">
								<td><h1></h1></td>
							</tr>
							<tr>
								<td><h3></h3></td>
							</tr>
							<tr>
								<td><h3>Express of Interest (EOI) ID <?php echo $_SESSION['eoiid'] ?> has rejected due to no matches. </h3></td>
							</tr>
							<tr>
								<td><h4><em>Page will be redirected to the list of EOI in 5 seconds.</em></h4></td>
							</tr>
							</table>
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
</html>


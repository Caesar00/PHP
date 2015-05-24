<html>
<title>Report Generated</title>
<?php 

session_start();
include "connection.php";
if(!isset($_SESSION['staff_id']))
{
header("Location: staff_login.php?page=reportgenerator.php");
}//force to login first
if(isset($_SESSION['staff_id'])&&$_SESSION['status']!="GRO")
{
	header("Location: 403error.php");//for non GRO accessing
}

?> 
<body>
<table border="0" align="center" id="outertable">
<!--table for header and footer and ensure alignment-->
<tr>
	<td><div id="header"> 
			<div id="logo"></div>
			</div>
	
<?php 
if($_POST['reporting']=="school")
{
	echo '<h1 align="center">School Ranking (FOR)<br>Based on Candidate Selection</h1>';
	if($_POST['fromdatesup']!="" && $_POST['todatesup']!="")
	{
	echo '<h3 align="center">From '.$_POST['fromdatesup'].' To '.$_POST['todatesup'].'</h3>';
	}
}
if($_POST['reporting']=="for")
{
	echo '<h1 align="center">Field of Research (FOR)<br>Based on Candidate Selection</h1>';
	if($_POST['fromdatefor']!="" && $_POST['todatefor']!="")
	{
	echo '<h3 align="center">From '.$_POST['fromdatefor'].' To '.$_POST['todatefor'].'</h3>';
	}
}
if($_POST['reporting']=="month")
{
	echo '<h1 align="center">Commencing Period <br>Based on Candidate Selection</h1>';
	if($_POST['fromdatecommence']!="" && $_POST['todatecommence']!="")
	{
	echo '<h3 align="center">From '.$_POST['fromdatecommence'].' To '.$_POST['todatecommence'].'</h3>';
	}
}
if($_POST['reporting']=="sup_prorata")
{
	echo '<h1 align="center">Supervisor Prorata</h1>';
}

$alleoi ="SELECT count(*) FROM eoi";
$alleoi_res = mysqli_query($con,$alleoi) or die(mysqli_error($con));
while($totaleoi = mysqli_fetch_array( $alleoi_res )) 
{
$eoitotalnum=$totaleoi['count(*)'];
}
$errdate ="";


if(isset($_POST['btnreport']))
{
/*		end of the loop*/
	if($_POST['reporting']=="")
	{
		echo "</td></tr><tr><td align='center'><br><br><br><h2>Please select a report that you wish to view </h2></td>";
		echo "<tr><td align='center'><h2> from the previous page. </h2></td>";
		echo "</tr><tr><td style='padding:5px 40px;'><br><div align='center'>"; 
		echo "<input type='submit' name='close' value='Close'  class='btn1' onclick='window.close();'/></div><br><br><br>";
	}
	if($_POST['reporting']!="")
	{
		if($_POST['reporting']=="school")
		{
			$fromdate= date('Y-m-d',strtotime(mysqli_real_escape_string($con,trim($_POST['fromdatesup']))));//changes record(string) to date
			$todate = date('Y-m-d',strtotime(mysqli_real_escape_string($con,trim($_POST['todatesup']))));//changes record(string) to date
			
			$reportgen ="select a.school_id, a.school_name, noofeoi , available_staff from (SELECT eoi.school_id, school.school_name, count(*) as noofeoi FROM eoi INNER JOIN school ON school.school_id=eoi.school_id ";
			if($_POST['fromdatesup']!="" && $_POST['todatesup']!="")
			{ 
				$reportgen .= " WHERE eoi.date_submit BETWEEN '$fromdate' AND '$todate'";
			}
			$reportgen .="GROUP BY school.school_id ORDER BY school.school_id ASC) a inner join
			(select x.school_id, x.school_name, count(x.staff_id) as available_staff from (SELECT school.Sc_No, school.name, supervisor.Sup_No,  SUM(sup_std.sup_percentage)/100 AS prorata FROM supervisor INNER JOIN sup_std ON sup_std.Sup_No=supervisor.Sup_No inner join school ON school.Sc_No=supervisor.Sc_No AND sup_std.end_date IS NULL GROUP BY supervisor.Sup_No ORDER BY Sc_No )x where (x.prorata <='2.8') group by x.Sc_No)b on a.Sc_No=b.Sc_No";
		}
		if($_POST['reporting']=="for")
		{
			$fromdate= date('Y-m-d',strtotime(mysqli_real_escape_string($con,trim($_POST['fromdatefor']))));//changes record(string) to date
			$todate = date('Y-m-d',strtotime(mysqli_real_escape_string($con,trim($_POST['todatefor']))));//changes record(string) to date
			$reportgen = "SELECT field_of_research.description, count(*) FROM select_for1 INNER JOIN field_of_research ON field_of_research.code=select_for1.code INNER JOIN eoi ON eoi.eoi_id=select_for1.eoi_id ";
			if($_POST['fromdatefor']!="" && $_POST['todatefor']!="")
			{ 
				$reportgen .= " WHERE eoi.date_submit BETWEEN '$fromdate' AND '$todate' ";
			}
			$reportgen .="GROUP BY field_of_research.description order by count(*) DESC ";
		}
		if($_POST['reporting']=="month")
		{
			$fromdate= date('Y-m-d',strtotime(mysqli_real_escape_string($con,trim($_POST['fromdatecommence']))));//changes record(string) to date
			$todate = date('Y-m-d',strtotime(mysqli_real_escape_string($con,trim($_POST['todatecommence']))));//changes record(string) to date
			$reportgen = "SELECT commence_month, commence_year, count(*) FROM eoi ";
			if($_POST['fromdatecommence']!="" && $_POST['todatecommence']!="")
			{ 
				$reportgen .= " WHERE eoi.date_submit BETWEEN '$fromdate' AND '$todate' ";
			}
			$reportgen .=" group by commence_year ORDER BY ";
			if($_POST['commence']=="month")
			{
				$reportgen .=" commence_month ASC ";
			}
			if($_POST['commence']=="year")
			{
				$reportgen .="commence_year ASC ";
			}
		}
		if($_POST['reporting']=="sup_prorata")
		{
			$reportgen = "SELECT school.Sc_No, school.name, staff_account.S_No, staff_account.salutation, staff_account.firstname, staff_account.surname, SUM(sup_percentage)/100 AS prorata FROM supervisor INNER JOIN sup_std ON sup_std.Sup_No=supervisor.Sup_No INNER JOIN school ON school.Sc_No=supervisor.Sc_No INNER JOIN staff_account ON staff_account.S_No=supervisor.Sup_No AND student_sup.end_date IS NULL GROUP BY supervisor.Sup_No";
			
			if($_POST['sortprorata']=="school")
			{
				$reportgen .="ORDER BY Sc_No ";
			}
			if($_POST['sortprorata']=="name")
			{
				$reportgen .="ORDER BY staff_id ";
			}
			if($_POST['sortprorata']=="prorata")
			{
				$reportgen .="ORDER BY prorata DESC";
			}
			
		}
		
		$_SESSION['reportname']= mysqli_real_escape_string($con,trim($_POST['reporting'])); //sames report name to differentiate excel file
		$report=""; // this is to save the table record for generation
		
		$reportgen_list = mysqli_query($con,$reportgen) or die(mysqli_error($con));
		echo "<table><tr><td  style='padding:5px 40px;'><fieldset>";
		echo "<table align='center'>";
		$report =  "<table align='center'>";
		if($fromdate > $todate)
		{
			$err="Yes";
			$errdate = "<tr><td align='center'><font color='#FF0000'><strong> ERROR: 'To' date cannot be earlier than 'From' date </strong></font></td></tr><tr><td style='padding:5px 40px;'><div align='center'>"; 
			echo $errdate;
			echo "<input type='submit' name='close' value='Close'  class='btn1' onclick='window.close();'/></div><br>";
		}
		$numrow_result = mysqli_num_rows($reportgen_list);
		if($numrow_result==0 && ($fromdate > $todate)!= true)
		{
			$err="Yes";
			echo "<tr><td align='center'><br><h4>No Results Found.</h4></td></tr>";
			echo "<tr><td align='center'><br><h4>Please edit the report that you wish to view </h4></td></tr>";
			echo "<tr><td align='center'><h4> from the previous page. </h4></td>";
			echo "</tr><tr><td style='padding:5px 40px;'><div align='center'>"; 
			echo "<input type='submit' name='close' value='Close'  class='btn1' onclick='window.close();'/></div><br>";
		}
		if($err=="")
		{
		?>
			</td></tr>
			<tr><td style="padding:5px 40px;" colspan="6">
			<div align="center"><form action="GenerateReport.php" method="post">
			<input type="submit" name="export" value="Export"  class="btn1"/></form>
			</div>
		<?php
			echo "<tr style='border-bottom-style:double;'>";
			if($_POST['reporting']=="school")
			{
				echo "<tr><th align='center' style='width:10%;'><strong>No.</strong>";
				echo "</th><th align='left' style='width:55%;'>";
				echo "<strong>School Name</strong>";
				echo "</th><th align='center' style='width:15%;'>";
				echo "<strong>EOI Selected</strong></th>";
				echo "<th><strong>Number of<br>Available Supervisor</strong></th></tr>";
				$report .=  "<tr><th align='center' style='width:10%;'><strong>No.</strong>";
				$report .=  "</th><th>";
				$report .=  "<strong>School Name</strong>";
				$report .=  "</th><th>";
				$report .=  "<strong>EOI Selected</strong></th>";
				$report .=  "<th><strong>Number of<br>Available Supervisor</strong></th></tr>";
			}	
			if($_POST['reporting']=="for")
			{
				echo "<tr><th align='center' style='width:10%;'>";
				echo "<strong>No.</strong>";
				echo "</th><th align='left' style='width:55%;'>";
				echo "<strong>Field of Research Name</strong>";
				echo "</th><th align='center' style='width:15%;'>";
				echo "<strong>EOI Selected<br><small>(numbers)</small></strong></th>";
				echo "<th align='center' style='width:20%;'><strong>EOI Selected<br><small>(percentage)</small></strong></th></tr>";
				$report .=  "<tr><th>";
				$report .=  "<strong>No.</strong>";
				$report .=  "</th><th>";
				$report .=  "<strong>Field of Research Name</strong>";
				$report .=  "</th><th>";
				$report .=  "<strong>EOI Selected<br><small>(numbers)</small></strong></th>";
				$report .=  "<th><strong>EOI Selected<br><small>(percentage)</small></strong></th></tr>";
			}		
			if($_POST['reporting']=="month")
			{
				echo "<tr><th align='center' style='width:30%;'>";
				echo "<strong>Commence Month</strong>";
				echo "</th><th style='width:30%;'>";
				echo "<strong>Commence Year</strong>";
				echo "</th><th align='center' style='width:20%;'>";
				echo "<strong>EOI Selected <br><small>(numbers)</small></strong></th>";
				echo "<th align='center' style='width:20%;'><strong>EOI Selected<br><small>(percentage)</small></strong></th></tr>";
				$report .=  "<tr><th>";
				$report .=  "<strong>Commence Month</strong>";
				$report .=  "</th><th>";
				$report .=  "<strong>Commence Year</strong>";
				$report .=  "</th><th>";
				$report .=  "<strong>EOI Selected <br><small>(numbers)</small></strong></th>";
				$report .=  "<th><strong>EOI Selected<br><small>(percentage)</small></strong></th></tr>";
			}			
			if($_POST['reporting']=="sup_prorata")
			{
				echo "<tr><th align='left' style='width:50%;'>";
				echo "<strong>School Name</strong>";
				echo "</th><th align='left' style='width:20%;'>";
				echo "<strong>Supervisor Title & Name</strong>";
				echo "</th><th align='center' style='width:15%;'>";
				echo "<strong>Prorata</strong></th>";
				echo "<th align='center' style='width:15%;'><strong>Workload</strong></th></tr>";
				$report .=  "<tr><th>";
				$report .=  "<strong>School Name</strong>";
				$report .=  "</th><th>";
				$report .=  "<strong>Supervisor Title & Name</strong>";
				$report .=  "</th><th>";
				$report .=  "<strong>Prorata</strong></th>";
				$report .=  "<th><strong>Workload</strong></th></tr>";
			}	
			$i =1;
			
			while ($report_output = mysqli_fetch_array($reportgen_list)) 
			{
				
				if($_POST['reporting']=="school")
				{
					$school_id[$i]=$report_output['Sc_No'];
					$school[$i]=$report_output['school_name'];
					$counter[$i]=$report_output['noofeoi'];
					$available_staff[$i]=$report_output['available_staff'];
					echo "<tr><td align='center'>".$school_id[$i]."</td>";
					echo "<td>".$school[$i]."</td>";
					echo "<td align='center'>".$counter[$i]."</td>";
					echo "<td align='center'>".$available_staff[$i]."</td></tr>";
					$report .="<tr><td align='center'>".$school_id[$i]."</td>";
					$report .="<td>".$school[$i]."</td>";
					$report .="<td align='center'>".$counter[$i]."</td>";
					$report .="<td align='center'>".$available_staff[$i]." %</td></tr>";
					$i++;
				}
				if($_POST['reporting']=="for")
				{
					$description[$i]=$report_output['description'];
					$counter[$i]=$report_output['count(*)'];
					$percentcount[$i]=(($counter[$i]/$eoitotalnum)*100);
					$percent[$i] = round($percentcount[$i], 1);
					echo "<tr><td align='center'>".$i."</td>";
					echo "<td>".$description[$i]."</td>";
					echo "<td align='center'>".$counter[$i]."</td>";
					echo "<td align='center'>".$percent[$i]." %</td></tr>";
					$report .= "<tr><td align='center'>".$i."</td>";
					$report .= "<td>".$description[$i]."</td>";
					$report .= "<td align='center'>".$counter[$i]."</td>";
					$report .= "<td align='center'>".$percent[$i]." %</td></tr>";
					$i++;
				}
				if($_POST['reporting']=="month")
				{
					$commence_month[$i]=$report_output['commence_month'];
					$month[$i] = date("M", mktime(0, 0, 0, $commence_month[$i], 10));
					$commence_year[$i]=$report_output['commence_year'];
					$counter[$i]=$report_output['count(*)'];
					$percentcount[$i]=(($counter[$i]/$eoitotalnum)*100);
					$percent[$i] = round($percentcount[$i], 1);
					echo "<tr><td align='center'>".$month[$i]."</td>";
					echo "<td align='center'>".$commence_year[$i]."</td>";
					echo "<td align='center'>".$counter[$i]."</td>";
					echo "<td align='center'>".$percent[$i]." %</td></tr>";
					$report .=  "<tr><td>".$month[$i]."</td>";
					$report .=  "<td>".$commence_year[$i]."</td>";
					$report .=  "<td>".$counter[$i]."</td>";
					$report .=  "<td>".$percent[$i]." %</td></tr>";
					$i++;
				}
				if($_POST['reporting']=="sup_prorata")
				{
					$school_name[$i]=$report_output['school_name'];
					$salutation[$i]=$report_output['salutation'];
					$firstname[$i]=$report_output['firstname'];
					$lastname[$i]=$report_output['lastname'];
					$fullname[$i] = $salutation[$i]." ".$firstname[$i]." ".$lastname[$i];
					$prorata[$i]=$report_output['prorata'];
					echo "<tr><td align='left'>".$school_name[$i]."</td>";
					echo "<td>".$fullname[$i]."</td>";
					echo "<td align='center'>".$prorata[$i]."</td>";
					echo "<td align='center'>";
					if($prorata[$i] > 3)
					{
						echo "Overload";
					}
					if($prorata[$i] < 1)
					{
						echo "Underload";
					}
					echo "</td></tr>";
					$report .=  "<tr><td align='left'>".$school_name[$i]."</td>";
					$report .=  "<td>".$fullname[$i]."</td>";
					$report .=  "<td>".$prorata[$i]."</td>";
					$report .=  "<td>";
					if($prorata[$i] > 3)
					{
						$report .=  "Overload";
					}
					if($prorata[$i] < 1)
					{
						$report .=  "Underload";
					}
					$report .=  "</td></tr>";
					$i++;
				}
			}
	
		}
	echo "</table>";
	echo "</fieldset></td></tr></table><br />";
	$report.="</table>";
	$_SESSION['report']=$report;	
	}
}
?></td>
  </tr>
  <tr>
    <td>
    <?php
	include ("footer.php");
	?>
    </td>
  </tr>
</table>
<p>&nbsp;  </p>
</body>
</html>
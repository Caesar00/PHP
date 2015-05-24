<script language="javascript" type='text/javascript'>
$(document).ready(function() {
	$("[name$=date]").datepicker({
		maxDate: new Date(),
		defaultDate: new Date(),
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
	});
	$("[name$=date]").attr("readonly",true);
});
function submitform(str)
{
	document.form.submit();
}
</script>

<div id="right_window" class="container2">
  <div class="title"> Annual Progress Reports List</div>
  <div class="content">
    <div class="formflow_h" style="width:80%;">
    <form method="post" name="form">
      <table cellspacing="3" cellpadding="5">
        <tr class="dark">
          <td>Choose the report:<select name="report"><option value="ptc">APR-Processes Time Consuming Summary</option></select></td>
        </tr>
        <tr class="light">
          <td>From:<input type="text" name="from_date" value=""/>To:<input type="text" name="to_date" value=""/></td>
        </tr>
      </table>
      <input name="param" type="hidden" value="" />
      </form>
      <p class="buttons"><a href="javascript:void()" onclick="submitform()">Generate</a></p>
    </div>
    <div class="formflow_h" style="width:80%;">
<?php
//header('Content-type: application/ms-excel');
//header('Content-Disposition: attachment; filename=test.pdf');
session_start();
if(isset($_POST['report']))
{
	if($_POST['report']=='ptc')
	{
		$date_from = $_POST['from_date'];
		$date_to = $_POST['to_date'];
		$query = "SELECT name,AVG(DATEDIFF(date2,date1)) AS interval1_avg, AVG(DATEDIFF(date3,date2)) AS interval2_avg,
		MIN(DATEDIFF(date2,date1)) AS interval1_min, MIN(DATEDIFF(date3,date2)) AS interval2_min,
		MAX(DATEDIFF(date2,date1)) AS interval1_max, MAX(DATEDIFF(date3,date2)) AS interval2_max 
		FROM apr_processing_time WHERE date1 > STR_TO_DATE('$date_from','%d-%m-%Y') AND date3 <= ADDDATE(STR_TO_DATE('$date_to','%d-%m-%Y'),INTERVAL 1 DAY) GROUP BY name";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$report[] = $row;
			}
			$report_title = "<h1>APR-Processes Time Consuming Summary</h1>";
			echo $report_title;
			$report_desc = "<p>Below table shows Minimum(MIN), Maximum(MAX), Average(AVG) days cost by Supervisors(SUP) and Deans(DEAN) processing an APR, and days spent for Whole(WHOLE) processing of an APR, these data are calculated for each school</p>";
			echo $report_desc;
			$report_table = "<table border=\"1\" cellspacing=\"0\" cellpadding=\"2\">
			<tr class=dark><td width=\"%28\">School</td><td width=\"%8\">MIN SUP</td><td width=\"%8\">MIN DEAN</td><td width=\"%8\">MIN WHOLE</td><td width=\"%8\">MAX SUP</td><td width=\"%8\">MAX DEAN</td><td width=\"%8\">MAX WHOLE</td><td width=\"%8\">AVG SUP</td><td width=\"%8\">AVG DEAN</td><td width=\"%8\">AVG WHOLE</td></tr>";
			echo "<table cellspacing=3 cellpadding=5>
			<tr class=dark><td>School</td><td>MIN SUP</td><td>MIN DEAN</td><td>MIN WHOLE</td><td>MAX SUP</td><td>MAX DEAN</td><td>MAX WHOLE</td><td>AVG SUP</td><td>AVG DEAN</td><td>AVG WHOLE</td></tr>";
			foreach($report as $key => $value)
			{
				$value['interval_avg'] = $value['interval1_avg'] + $value['interval2_avg'];
				$value['interval_max'] = $value['interval1_max'] + $value['interval2_max'];
				$value['interval_min'] = $value['interval1_min'] + $value['interval2_min'];
				$row="<tr class=light><td>$value[name]</td><td>$value[interval1_min]</td><td>$value[interval2_min]</td><td>$value[interval_min]</td>
				<td>$value[interval1_max]</td><td>$value[interval2_max]</td><td>$value[interval_max]</td>
				<td>$value[interval1_avg]</td><td>$value[interval2_avg]</td><td>$value[interval_avg]</td></tr>";
				echo $row;
				$report_table = $report_table.$row;
			}
			$report_table = $report_table.'</table>';
			echo "</table>";
			$report_filename = 'APR-Processes Time Consuming Summary '.date('d-m-Y').'.pdf';
			$report_content=$report_title.$report_desc.$report_table;
			$report_generator=array('filename'=>$report_filename,'content'=>$report_content);
			$_SESSION['report_generator']=$report_generator;
			session_commit();
			echo "<p class='buttons'><a href='pdf_generator.php' target='_new'>Export Report</a></p>";
		}
		else
			echo "<h1>No data found</h1>";
	}
}
session_commit();
?>

    </div>
  </div>
</div>

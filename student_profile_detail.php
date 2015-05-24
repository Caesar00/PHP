<?php
$name = $user['salutation'].' '.$user['firstname'].' '.$user['surname'];
$query = "SELECT name FROM school WHERE Sc_NO = $user[Sc_NO]";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$school1 = mysqli_fetch_array($result);
$query = "SELECT name FROM school WHERE Sc_NO = $user[sub_school]";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$school2 = mysqli_fetch_array($result);
$query = "SELECT country_name FROM citizenship WHERE citizenship = '$user[citizenship]'";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$country = mysqli_fetch_array($result);
$query = "SELECT CONCAT(sa1.salutation,' ',sa1.firstname,' ',sa1.surname) as p_supervisor,CONCAT(sa2.salutation,' ',sa2.firstname,' ',sa2.surname) as c_supervisor FROM staff_account sa1,staff_account sa2 WHERE sa1.S_NO = $user[p_supervisor] and sa2.S_NO = $user[c_supervisor];";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$supervisor = mysqli_fetch_array($result);
?>
<script language="javascript" type='text/javascript'>
</script>
<div id="right_window" class="container2">
<div class="title"> Your Personal Details </div>
<div class="content">
<div class="formflow_h" style="width:80%">
  <table cellspacing="3" cellpadding="5" style="width:100%">
    <col class="dark"  style="width:170px"/>
    <col class="light" style="width:200px"/>
    <col class="dark"  style="width:170px"/>
    <col class="light" />
    <tr>
      <td class="dark">Full Name</td>
      <td><?php echo $name; ?></td>
      <td>Student Number</td>
      <td><?php echo $user['Stud_NO']; ?></td>
    </tr>
    <tr>
      <td class="dark">Citizenship</td>
      <td colspan="3"><?php echo $country['country_name']; ?></td>
    </tr>
    <tr>
      <td class="dark">Telephone</td>
      <td colspan="3"><?php echo $user['telephone']; ?></td>
    </tr>
    <tr>
      <td>Email Address</td>
      <td colspan="3"><?php echo $user['email']; ?></td>
    </tr>
    <tr>
      <td>Commencement Date</td>
      <td><?php echo $user['commencement_date']; ?></td>
      <td>Enrollment Type</td>
      <td><?php echo $user['enrollment_type']; ?></td>
    </tr>
    <tr>
      <td>School</td>
      <td colspan="3"><?php echo $school1['name']; ?></td>
    </tr>
    <tr>
      <td>AOU/Sub-School</td>
      <td colspan="3"><?php echo $school2['name']; ?></td>
    </tr>
    <tr>
      <td>Scholarship Type</td>
      <td><?php echo $user['scholarship_type']; ?></td>
      <td>Degree enrolled</td>
      <td><?php echo $user['degree_enrolled']; ?></td>
    </tr>
    <tr>
      <td>Principal Supervisor</td>
      <td><?php echo $supervisor['p_supervisor']; ?></td>
      <td>Co Supervisors</td>
      <td><?php echo $supervisor['c_supervisor']; ?></td>
    </tr>
  </table>
<form name="form1" method="post">
<input name="param" type="hidden" value="" />
</form>
</div>
<div style="height:1px"> </div>
</div>

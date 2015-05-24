<?php 
    session_start();
    if(isset($_SESSION['ml']))
    {
        $ml = $_SESSION['ml'];
    }
    if(!isset($_SESSION['sups']))
    {
        $sups_query = 'SELECT S_NO, type, salutation, firstname, surname, email FROM staff_account WHERE S_NO IN (SELECT account_id FROM mls_attendee WHERE attendee_type = \'supervisor\' AND meeting_id = '.$ml['meeting_id'].')';
        $sups_result = mysqli_query($con,$sups_query) or die(mysqli_error($con));
        while ($sup = mysqli_fetch_assoc($sups_result)) {
            $sups[] = $sup;
        }
        $_SESSION['sups'] = $sups;
    }
    session_commit();
?>
<div class="formflow_h" style="width:80%">
  <table cellspacing="3" cellpadding="5" style="width:100%">
    <th colspan="4">Details of Meeting</th>
    <col class="dark"  style="width:20%"/>
    <col class="light" style="width:25%"/>
    <col class="dark"  style="width:20%"/>
    <col class="light" />
    <tr>
      <td>ID</td>
      <td><?php echo $ml['meeting_id']; ?></td>
      <td>Confirmation Staus</td>
      <td style="color:red; text-transform: uppercase;"><?php echo $ml['confirmation_status']; ?></td>
    </tr>
    <tr>
      <td>Location</td>
      <td><?php echo $ml['location']; ?></td>
    </tr>
    <tr>
      <td>Date</td>
      <td colspan="3"><?php echo $ml['date']; ?></td>
    </tr>
    <tr>
      <td>From</td>
      <td><?php echo $ml['commenced_time']; ?></td>
      <td>To</td>
      <td><?php echo $ml['adjourned_time']; ?></td>
    </tr>
    <?php
        if($ml['confirmation_status'] == 'confirmed')
        {
            echo "<tr><td>Preparation Time</td><td>".$ml['preparation_time']."</td></tr>";
        }

    ?>
    <tr>
      <td>Meeting Mintues</td>
      <td colspan=3>
          <p>
              <textarea disabled name="minutes" maxlength='2000' style='width: 99%; height: 120px;'><?php printText($ml,'meeting_minutes');?></textarea>
          </p>
      </td>
    </tr>
</table>
<table cellspacing="3" cellpadding="5" style="width:100%">
    <col class="dark"  style="width:20%"/>
    <col class="light" style="width:25%"/>
    <col class="dark"  style="width:20%"/>
    <col class="light" />
    <?php
        $sups = $_SESSION['sups'];
        echo '<th colspan=4>Details of Attended Supervisors('.sizeof($sups).')</th>';
        echo "<tr></tr>";
        foreach($sups as $sup) {
            echo '<tr><td colspan=4 style=\'text-align:center;\'>'.$sup['salutation']. '. '.$sup['firstname'].' '.$sup['surname'].'</td></tr>';

            echo "<tr><td>Supervisor No</td><td>";
            echo $sup['S_NO'].'</td>';
            echo "<td>Type</td><td>";
            echo $sup['type'].'</td></tr>';

            echo "<tr><td>Email</td><td colspan=3>";
            echo $sup['email'].'</td></tr>';
            echo "<tr><td colspan=4 class=light><br /><td></tr>";
        }
    ?>
</table>
  <?php
    if ($ml['comments'] != '')
    {
        echo "<form name=form1 method=post>
              <table cellspacing=3 cellpadding=5 style=width:100%>
              <col class=dark />
              </table>
              <table cellspacing=3 cellpadding=5 style=width:100%>
              <col class=dark />
              <th colspan=4>Other</th>
              <tr>
              <td>Supervisors' Comments: <span>
              <input disabled type=text name=title size=100 value=".$ml['comments']." />
              </span></td>
              </tr>
              </table>
              </form>";
    }
    ?>
</div>

<?php
$apr_b = $_SESSION['apr_b'];
$apr_b_res = mysqli_query($con, "SELECT * FROM apr_b WHERE APR_NO='$apr_b[APR_NO]'") or die(mysqli_error($con));
$row = mysqli_fetch_array($apr_b_res);

$apr_b['progressRate']=$row['rate'];
$apr_b['informGRO']=$row['inform_gro'];
$apr_b['thesisSubmittable']=(isset($row['submission_detail']) ? "Yes" : "No");
$apr_b['submissionDetail']=$row['submission_detail'];
$apr_b['lateSubmits']=$row['fail_deadline'];
$apr_b['avoidContact']=$row['avoid_contacting'];
$apr_b['supChanged']=$row['change_experienced'];
$apr_b['lowInterest']=$row['interest_diminishing'];
$apr_b['comment1']=$row['clarify_comment1'];
$apr_b['milestoneComp']=$row['milestone_completed'];
$apr_b['sufficientDetail']=$row['sufficient_detail'];
$apr_b['paperProduce']=$row['paper_produce'];
$apr_b['draftStandard']=$row['standard_produce'];
$apr_b['comment2']=$row['clarify_comment2'];
$apr_b['studLeave']=$row['leaving_confirm'];
$apr_b['overall']=$row['overall_comment'];
$apr_b['supLeave']=(isset($row['absent_arrangement']) ? "Yes" : "No");
$apr_b['altSupArea']=$row['absent_arrangement'];
$apr_b['discontinue']=(isset($row['none_recommend_reason']) ? "Yes" : "No");
$apr_b['discontinueStatement']=$row['none_recommend_reason'];
$_SESSION['apr_b']=$apr_b;
?>

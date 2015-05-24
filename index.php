<?php
session_start();
include "connection.php";
error_reporting(-1);
if(isset($_POST['login_btn']))
{
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$query = "SELECT App_NO FROM applicant WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($con,$query) or die(mysqli_error($con));

	if(mysqli_num_rows($result) == 1)
	{
		$id = mysqli_fetch_array( $result );
		$_SESSION["id"] = $id['App_NO'];
		$_SESSION["role"] = 'stu';
		session_commit();
		header("Location: student_index.php");
	}
	else
	{
		$login_err = "Invalid Username or Password.";
	}
}

if(isset($_GET['timedOut']))
{
	$login_err = "Your session has timed out.";
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>HDR | Murdoch</title>
        <script src="js/jquery-1.9.1.js"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <?php include "header.php";	?>
    <script>
        $(document).ready(function(){
          $("a#showmore").click(function(){
            $(this).hide();
            $("div#readmore").show();
          });
          $("a#hidemore").click(function(){
            $("a#showmore").show();
            $("div#readmore").hide();
          });
        });
    </script>
    <div class="navigator">
        <a class="selected" href="index.php">Student and Applicant</a><span>|</span> 
        <a href="staff_login.php">Staff</a>
    </div>
    <div class="container1" style="width:60%; float:left; margin:20px 0 20px 30px">
      <div class="title">Welcome to Murdoch HDR system</div>
      <div class="text">
        <h3>Research study</h3>
        <p>Murdoch University is one of the leading research universities in Australia and prides itself on the quality and depth of its research. Home to a supportive, stimulating environment, we provide research students with high quality training in an international context.</p>
        <p>We have very strong research links with industry which ensures that our research students are trained in areas of national and international relevance. This takes our students to the leading edge of their disciplines and aligns them with current and future industry and society needs.</p>
        <p>In 2006, Murdoch generated a record research income of over $35 million through nationally competitive grants, industry funding, grants from State and Commonwealth agencies and research consultancies. Murdoch University received a five-star rating for research intensity from the Good Universities Guide which comes based on our per capita research performance. This puts Murdoch in the top eight universities nationally and reinforces our excellent research reputation.</p>
        <a href="javascript:void()" id="showmore">readmore...</a>
        <div id="readmore" class="none">
          <p>We offer a range of research programs covering many areas including:</p>
          <h4>PhD</h4>
          <p>The Doctor of Philosophy (PhD) involves the student independently researching a specific topic under the guidance of a supervisor. This research involves critical and creative activities and disciplined methods of inquiry designed to increase the stock of human knowledge.
          </p>
          <h4>Master of Philosophy</h4>
          <p>The Master of Philosophy is also a supervised research program involving the independent research of a specific topic under the guidance of a supervisor. The candidate must undertake an original investigation which would normally be more limited in scope and degree of originality than for a PhD.
          </p>
          <h4>Research Masters with Training</h4>
          <p>The Research Masters with Training is an 18 month full time degree designed for students for whom additional, or specialised, research training is desirable. It is suitable for industry professionals who seek to extend and deepen their research expertise and undertake research relevant to their professional field; and those hoping to proceed to a higher degree but lacking in the conventional background.
          </p>
          <h4>Master of Education (Research)</h4>
          <p>Students studying the Master of Education (MEd) undertake a research dissertation combined with a limited number of coursework units to both inform their dissertation and provide an appropriate methodology background. This course is designed to provide the education profession and the community with leaders capable of addressing critical issues in educational practice, policy and research.
          </p>
          <h4>Doctor of Education</h4>
          <p>The Doctor of Education is an intensive course of study consisting of coursework and applied research in a selected area of practice leading to a dissertation that contributes conceptually and practically to the profession.
          </p>
          <h4>Master of Laws (Research)</h4>
          <p>The Master of Laws (LLM) is designed to extend the opportunity for law students to undertake research at an advanced level.
          </p>
          <h4>Master of Applied Psychology + PhD</h4>
          <p>This combined course is offered to students wishing to combine professional training at Master's level in Clinical or Organisational Psychology with compatible research at the PhD level. It combines thorough, professional training in the chosen area of specialisation with the high level of research training associated with doctoral-level studies.
          </p>
          <a href="javascript:void()" id="hidemore">readless</a>
        </div>
        <p>Find out more about 
            <a href="http://www.murdoch.edu.au/Research-capabilities/">Research Capabilities at Murdoch.</a> 
        </p>
      </div>
    </div>
    <div class="container1" style="width:33%; float:right; margin:20px 30px 20px 0">
      <div class="title">Login</div>
      <div class="text">
        <form method="post">
          <p>
            <span style="display:inline-block; width:30%; text-align:right">Username:</span>
            <input type="text" name="username" style="width:55%"/>
          </p>
          <p>
            <span style="display:inline-block; width:30%; text-align:right">Password:</span>
            <input type="password" name="password" style="width:55%"/>
          </p>
          <p style="color:#f00; text-align:center; font-weight:bold;">
            <?php if(isset($login_err))echo($login_err);?></p>
          <p style="text-align:center">
            <input type="submit" name="login_btn" value="Login" style="margin-right:3px;background:#333;text-decoration:none;color:#fff;padding:5px;width:80px;text-align:center;display:inline-block;"/>
          </p>
        </form>
      </div>
    </div>
    <?php include 'footer.php';?>
</body>
</html>

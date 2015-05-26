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
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-6" />
        <title>HDR+</title>
        <?php include "resources.php"; ?>
    </head>
    <body>
        <?php include "header3.php"; ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="jumbotron" style="background: url('http://imgur.com/C0q5Tie.jpg');">
                        <h1 style="color: white">Welcome to Murdoch HDR system</h1>
                            <p style="color:white">urdoch University is one of the leading research universities in Australia and prides itself on the quality and depth of its research. Home to a supportive, stimulating environment, we provide research students with high quality training in an international context.</p>
							<p style="color:white">We have very strong research links with industry which ensures that our research students are trained in areas of national and international relevance. This takes our students to the leading edge of their disciplines and aligns them with current and future industry and society needs.</p>
                   <!--     <p><a class="btn btn-primary btn-lg">Read More</a></p>-->
<div class="panel-group" id="accordion">
        <a class="btn btn-primary btn-lg" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
         Read More
        </a>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
	<p style="color:white">
        In 2006, Murdoch generated a record research income of over $35 million through nationally competitive grants, industry funding, grants from State and Commonwealth agencies and research consultancies. Murdoch University received a five-star rating for research intensity from the Good Universities Guide which comes based on our per capita research performance. This puts Murdoch in the top eight universities nationally and reinforces our excellent research reputation.
	</p>
	<p style="color:white">
          We offer a range of research programs covering many areas including:</p>
          <h4 style="color:white">PhD</h4>
	<p style="color:white">
          The Doctor of Philosophy (PhD) involves the student independently researching a specific topic under the guidance of a supervisor. This research involves critical and creative activities and disciplined methods of inquiry designed to increase the stock of human knowledge.
          </p>
          <h4 style="color:white">Master of Philosophy</h4>
	<p style="color:white">
          The Master of Philosophy is also a supervised research program involving the independent research of a specific topic under the guidance of a supervisor. The candidate must undertake an original investigation which would normally be more limited in scope and degree of originality than for a PhD.
          </p>
          <h4 style="color:white">Research Masters with Training</h4>
	<p style="color:white">
          The Research Masters with Training is an 18 month full time degree designed for students for whom additional, or specialised, research training is desirable. It is suitable for industry professionals who seek to extend and deepen their research expertise and undertake research relevant to their professional field; and those hoping to proceed to a higher degree but lacking in the conventional background.
          </p>
          <h4 style="color:white">Master of Education (Research)</h4>
	<p style="color:white">
          Students studying the Master of Education (MEd) undertake a research dissertation combined with a limited number of coursework units to both inform their dissertation and provide an appropriate methodology background. This course is designed to provide the education profession and the community with leaders capable of addressing critical issues in educational practice, policy and research.</p>
          <h4 style="color:white">Doctor of Education</h4>
	<p style="color:white">
          The Doctor of Education is an intensive course of study consisting of coursework and applied research in a selected area of practice leading to a dissertation that contributes conceptually and practically to the profession.
          </p>
          <h4 style="color:white">Master of Laws (Research)</h4>
	<p style="color:white">
          The Master of Laws (LLM) is designed to extend the opportunity for law students to undertake research at an advanced level.
          </p>
          <h4 style="color:white">Master of Applied Psychology + PhD</h4>
	<p style="color:white">
          This combined course is offered to students wishing to combine professional training at Master's level in Clinical or Organisational Psychology with compatible research at the PhD level. It combines thorough, professional training in the chosen area of specialisation with the high level of research training associated with doctoral-level studies.
          </p>
      </div> 
  </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="http://i.imgur.com/xxUBQDj.jpg">
                        <div class="caption">
                            <h4>Expression Of Interest</h4>
                            <p>Apply for a research program within a matter of minutes.</p>
								<!-- Button trigger modal -->
								<button class="btn btn-success" data-toggle="modal" data-target="#myModal1">
									Demos 
								</button>

								<!-- Modal -->
								<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<h4 class="modal-title" id="myModalLabel1">Expression of Interest</h4>
									  </div>
									  <div class="modal-body">
										The Expression of Interest system stores a record of the student's experience, scholarships and qualifications. This information is then used to match the student with a supervisor in the same field. The applicant can submit, edit and manage EOI applications through a registered account. Applicants receive emails from the EOI system regarding status changes of their applications.
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="http://i.imgur.com/xxUBQDj.jpg">
                        <div class="caption">
                            <h4>Annual Progress Report</h4>
                            <p>Generate detailed progress report that is tailored for you.</p>
								<!-- Button trigger modal -->
								<button class="btn btn-success" data-toggle="modal" data-target="#myModal2">
									Demos 
								</button>

								<!-- Modal -->
								<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<h4 class="modal-title" id="myModalLabel2">Annual Progress Report</h4>
									  </div>
									  <div class="modal-body">
										Supervisors receive annual progress reports from their students. These annual progress reports store what field the student is in, their enrolment status and other information important to the supervisor. This detailed information can then be used by the supervisor as an overview of what the student is doing.
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="http://i.imgur.com/xxUBQDj.jpg">
                        <div class="caption">
                            <h4>Meeting Log Management</h4>
                            <p>Recording a meeting has never been this easy.</p>
								<!-- Button trigger modal -->
								<button class="btn btn-success" data-toggle="modal" data-target="#myModal3">
									Demos 
								</button>

								<!-- Modal -->
								<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<h4 class="modal-title" id="myModalLabel3">Meeting Log Management</h4>
									  </div>
									  <div class="modal-body">
										Create a meeting log which stores a meeting's date, time, location and meeting minutes. The meeting log also records which supervisors were present at the meeting.
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="http://i.imgur.com/xxUBQDj.jpg">
                        <div class="caption">
                            <h4>Research Progress Monitor</h4>
                            <p>Receive academic reminders to keep you informed.</p>
								<!-- Button trigger modal -->
								<button class="btn btn-success" data-toggle="modal" data-target="#myModal4">
									Demos 
								</button>

								<!-- Modal -->
								<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<h4 class="modal-title" id="myModalLabel4">Research Progress Monitor</h4>
									  </div>
									  <div class="modal-body">
										Send half yearly reminders to the supervisors requiring them to continue a student's candidature.
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "footer3.php" ?>
        </div>
    </body>
</html>

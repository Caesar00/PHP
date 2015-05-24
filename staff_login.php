<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Murdoch University Expression Of Interest In Higher Degree Research Candidature</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
        session_start(); // Start/resume session cookie
        include "connection.php";
        include 'header.php';
        
        /* this shows the error message when the page goes white
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        if ($_SESSION['is_admin'])
        {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        }
        ini_set('html_errors', 'On');*/
//        $errlogin="";
  
        //isset is used to not run following command if button not pressed
        if (isset($_POST['login_btn'])) { 	
            //retrieve login records from database
            /** @desc String escaped ID of username entered. */
            $id= mysqli_real_escape_string($con, $_POST['staff_id']);// username entered of person logged in
            /** @var String escaped password entered. */
            $password= mysqli_real_escape_string($con, $_POST['pass']);


            /** @var mixed used to store result of prepared statement. This query checks if username and password are correct. */
            $get_user_res = mysqli_query($con, "SELECT * FROM staff_account WHERE BINARY 
                S_NO = BINARY '$id' AND BINARY password = BINARY md5('$password')");

            if (mysqli_num_rows($get_user_res) == 1) //if login record is correct
            {
                if(isset($_SESSION))
                {
                    unset($_SESSION);
                    session_destroy();
                    session_start();
                }
                /** @var mixed Array of the row or NULL if no more rows*/
                $user = mysqli_fetch_array( $get_user_res ); // while there are rows to iterate through. 
                
                /** @var String ID of the user */
                $staff_id=$user['S_NO']; 
                /** @var mixed (String) of status of the user */
                $status=$user['type'];
                /** @var mixed (String) for last login of the staff*/
                $last_login=$user['last_login'];
                $_SESSION['staff_id'] = $staff_id;//ensure that all page will still log in, if not page will take it as not logged in
                $_SESSION['status'] = $status;//store the status variable to ensure that they only access specific sites
                session_write_close();
                    // update the last login time of the user
                    mysqli_query($con,"UPDATE staff_account SET last_login = now() WHERE S_NO='$staff_id'");
                if(!isset($page))
                {
                    if($status == "Sup")
                    {
                        if($last_login =="0000-00-00") // check if is first time log in
                        {
                            header("Location: Staff_ProfilePage.php");
                        }
                        else
                        {
                            header("Location: Staff_CurrentStudent.php");
                        }
                    }
                    else if($status == "GRO")
                    {
                        header("Location: gro_index.php"); //jump to another page
                    }
                    else if($status == "Dean")
                    {
                        header("Location: dean_index.php");
                    }
                }
                else {
                    header("Location: " .$page); //jump to previous page that user access straight
                }
            }
            else 
            {
                $errlogin="*We were unable to match the User ID and password you entered. Please check your entries and try again.";
            }
        }
        ?>
<div class="navigator"> <a  href="index.php">Student and Applicant</a><span>|</span> <a class="selected" href="staff_login.php">Staff</a> </div>
<div>
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
        <p>
        <h4>PhD</h4>
        The Doctor of Philosophy (PhD) involves the student independently researching a specific topic under the guidance of a supervisor. This research involves critical and creative activities and disciplined methods of inquiry designed to increase the stock of human knowledge.
        </p>
        <p>
        <h4>Master of Philosophy</h4>
        The Master of Philosophy is also a supervised research program involving the independent research of a specific topic under the guidance of a supervisor. The candidate must undertake an original investigation which would normally be more limited in scope and degree of originality than for a PhD.
        </p>
        <p>
        <h4>Research Masters with Training</h4>
        The Research Masters with Training is an 18 month full time degree designed for students for whom additional, or specialised, research training is desirable. It is suitable for industry professionals who seek to extend and deepen their research expertise and undertake research relevant to their professional field; and those hoping to proceed to a higher degree but lacking in the conventional background.
        </p>
        <p>
        <h4>Master of Education (Research)</h4>
        Students studying the Master of Education (MEd) undertake a research dissertation combined with a limited number of coursework units to both inform their dissertation and provide an appropriate methodology background. This course is designed to provide the education profession and the community with leaders capable of addressing critical issues in educational practice, policy and research.
        </p>
        <p>
        <h4>Doctor of Education</h4>
        The Doctor of Education is an intensive course of study consisting of coursework and applied research in a selected area of practice leading to a dissertation that contributes conceptually and practically to the profession.
        </p>
        <p>
        <h4>Master of Laws (Research)</h4>
        The Master of Laws (LLM) is designed to extend the opportunity for law students to undertake research at an advanced level.
        </p>
        <p>
        <h4>Master of Applied Psychology + PhD</h4>
        This combined course is offered to students wishing to combine professional training at Master's level in Clinical or Organisational Psychology with compatible research at the PhD level. It combines thorough, professional training in the chosen area of specialisation with the high level of research training associated with doctoral-level studies.
        </p>
        <a href="javascript:void()" id="hidemore">readless</a> </div>
      <p>Find out more about <a href="http://www.murdoch.edu.au/Research-capabilities/">Research Capabilities at Murdoch.</a> 
    </div>
  </div>
  <div class="container1" style="width:33%; float:right; margin:20px 30px 20px 0;">
    <div class="title">Login</div>
    <div class="text">
      <form method="post">
      <p><span style="display:inline-block; width:30%; text-align:right">Username:</span>
        <input type="text" name="staff_id" id="textfield2" value="<?php if (isset($_POST['login_btn'])){ echo $_REQUEST['staff_id'];}?>" style="width:55%"/>
      </p>
      <p><span style="display:inline-block; width:30%; text-align:right">Password:</span>
        <input type="password" name="pass" id="textfield" style="width:55%"/>
      </p>
      <p style="color:#f00; text-align:center; font-weight:bold;"><?php if(isset($login_err))echo($login_err);?></p>
      <p style="text-align:center">
        <input type="submit" name="login_btn" value="Login" style="margin-right:3px;background:#333;text-decoration:none;color:#fff;padding:5px;width:80px;text-align:center;display:inline-block;"/>
      </p>
    </form>
    </div>
  </div>
</div>
<div style="clear:both">
  <?php
        include 'footer.php';
		?>
</div>
</body>
</html>

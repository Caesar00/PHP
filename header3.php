<div class="container" style="margin-top:20px;">
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://www.murdoch.edu.au"><img src="Image/Logo/Logo.png" height="26" class="img-rounded"></img></a>
            <a class="navbar-brand hidden-xs" href="index3.php">HDR <i id="plugSign" class="fa fa-plus"></i></a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <?php 
                if (isset($_SESSION['id']))
                {
                    include 'student_nav3.php';
                }
                elseif (isset($_SESSION['staff_id'])) {
                    $status = $_SESSION['status'];
                    if($status == 'Sup') {
                        include 'staff_nav3.php';
                    }
                    elseif ($status == 'GRO') {
                        include 'staff_nav3.php';
                    }
                    elseif ($status = 'Dean') {
                        include 'staff_nav3.php';
                    }
                }
                else {
                    echo '<ul class="nav navbar-nav navbar-right"><li><a href="login.php"><i class="fa fa-lg fa-sign-in"></i> Login</a></li>
                         <li><a href="#"><i class="fa fa-lg fa-info-circle"></i> About</a></li></ul>';
                }
            ?>
        </div>
    </div>
</div>

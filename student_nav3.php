<ul class="nav navbar-nav navbar-left">
    <!-- <li><a href="#"><i class="fa fa-mortar-board"></i> New EOI</a></li> -->
   <!-- <li><a href="#"><i class="fa fa-lg fa-bar-chart"></i> APR</a></li>-->
    <li><a href="student_index3.php?cont=MLS"><i class="fa fa-lg fa-pencil-square-o"></i> MLS</a></li>
    <li><a href="student_index3.php?cont=RPM"><i class="fa fa-lg fa-calendar"></i> RPM</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?php
            $u = $_SESSION['user'];
            echo $u['firstname'].' '.$u['surname'];
        ?>
        <b class="caret"></b>
    </a>
        <ul class="dropdown-menu">
            <li><a href="student_index3.php?act=update">Update Profile</a></li>
            <li><a href="student_index3.php?act=password">Change Password</a></li>
            <li class="divider"></li>
            <li><a href="logout.php"><i class="fa fa-sign-out" ></i> Log out</a></li>
        </ul>
    </li>
</ul>

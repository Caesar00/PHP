<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.9.1.js"></script>


<div class="navigator">

	<div style="float:left;">
    <a href="Staff_ProfilePage.php">My Profile</a><span>|</span> 
    <a href="Staff_CurrentStudent.php">Current Student(s)</a><span>|</span> 
    <a href="reportgenerator.php">Reports</a><span>|</span> 
    <a href="staff_APR.php">Annual Progress Report</a><span>|</span>
    <a href="staff_MLS.php">Meeting Log System</a>
    </div>
    <div style="float:right; vertical-align:middle;">
    <?php
	include "loginmenu.php";
	?>
    </div>
    
    </div>
<script>
    function rmvClasses()
    {
        $('.navigator a').each(function(){$(this).removeClass('selected');});
    }
    $(document).ready(function() {
        var mainDone = false;
        var done = false;
    $('.navigator a').each(function() {
        if(!mainDone)
            {
        if ($(this).prop('href') == window.location.href) {
            var aLink = $(this);
            rmvClasses();
            $(this).addClass('selected');
            mainDone = true;
        }
        else if($(this).prop('href')==window.location.href.substr(0,window.location.href.lastIndexOf("&"))){
            rmvClasses();
            $(this).addClass('selected');
            done = true;
        }
        else if($(this).prop('href')==window.location.href.substr(0,window.location.href.lastIndexOf("?")) && !done){
            $(this).addClass('selected');
        }
            }
    });
    $('.leftmenu a').each(function() {
        if ($(this).prop('href') == window.location.href) {
            $(this).addClass('selected');
        }
    });
});
</script>

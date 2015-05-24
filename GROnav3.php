<div class="navigator">

	<div style="float:left;">
    <a href="gro_index.php">My Profile</a><span>|</span> 
    <a href="GRO_ListOfEOI.php">List of New EOI Applications</a><span>|</span> 
    <a href="search.php">Search EOI Applications</a><span>|</span> 
    <a href="reportgenerator.php">Reports</a><span>|</span> 
    <a href="gro_index.php?cont=APR">APR</a>
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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
              if(isset($_GET['act']))
              {
                  if($_GET['act']=="submit")
                  {
                      include "student_submit_mls3.php";
                  }
                  if($_GET['act']=="view")
                  {
                      include "student_view_mls3.php";
                  }
                  if($_GET['act']=="report")
                  {
                      include "student_report_mls3.php";
                  }
                   if($_GET['act']=="search")
                  {
                      include "student_search_mls3.php";
                  }
             }
              else
              {
                  include "student_mls_list3.php";
              }
            ?>
        </div>
    </div>
</div>

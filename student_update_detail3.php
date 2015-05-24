<?php
    session_start();
    $query = "SELECT * FROM citizenship";
    $result = mysqli_query($con,$query) or mysqli_error($con);

    while($row = mysqli_fetch_array($result))
    {
        $countries[] = $row;
    }

    if(isset($_POST['param']))
    {
        $detail['salutation'] = $_POST['select1'];
        $detail['firstname'] = $_POST['text1'];
        $detail['surname'] = $_POST['text2'];
        $detail['citizenship'] = $_POST['select2'];
        $detail['telephone'] = $_POST['text3'];
        $detail['email'] = $_POST['text4'];
        $query = "UPDATE applicant SET salutation='$detail[salutation]', firstname='$detail[firstname]', surname='$detail[surname]',citizenship='$detail[citizenship]', telephone='$detail[telephone]',email='$detail[email]' WHERE App_NO = $user[App_NO]";
        $result = mysqli_query($con,$query) or mysqli_error($con);
        if($result) {
            $_SESSION['update_msg'] = "Your details have been saved.";
            header("Location: student_index3.php?act=update");
            session_commit();
        }
    }
    function printSalutation($param)
    {
        $salutation = array('Mr','Ms','Mrs','Mdm','Dr','Prof');
        foreach( $salutation as $value)
        {
            echo "<option value='$value' ";
            if($value == $param)
            {
                echo "selected = 'selected'";
            }
            echo ">$value</option>";
        }
    }
    function printCitizenship($array,$param)
    {
        foreach( $array as $value)
        {
            echo "<option value='$value[citizenship]' ";
            if($value['citizenship'] == $param)
            {
                echo "selected = 'selected'";
            }
            echo ">$value[country_name]</option>";
        }
    }
?>
<script language="javascript" type='text/javascript'>
    function submitform(func,str)
    {
        var result = func();
        if(result)
        {
            return;
        }
        document.form1.param.value=str;
        document.form1.submit();
    }
    function validation()
    {
        for(var j=1;j<5;j++)
        {
            var text = document.getElementsByName('text'+i);
            if(text[0] != null && text[0].value == '')
            {
                var text_w = $id('text'+i+'_w');
                text_w.className = "";
                result = true;
            }
        }
    }
</script>
<div class="container">
    <form class="form-horizontal" name="form1" method="post">
        <fieldset>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Profile Detail</h4>
                </div>
                <div class="panel-body">
                <?php
                    if(isset($_SESSION['update_msg'])) {
                        echo '<div class="alert alert-dismissable alert-success text-center">
                            <button type="button" class="close" data-dismiss="alert">×</button>'
                            .$_SESSION['update_msg'].'</div>';
                    }
                    unset($_SESSION['update_msg']);
                    session_commit();
                ?>
                    <div class="form-group">
                        <label for="select1" class="col-sm-2 control-label">Salutation</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="select1" ><?php printSalutation($user['salutation']); ?></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="col-sm-2 control-label">Firstname</label>
                        <div class="col-sm-4">
                            <input class="form-control" id="text1" name="text1" value="<?php echo $user['firstname'] ?>" placeholder="Firstname">
                        </div>
                        <label for="text2" class="col-sm-2 control-label">Surname</label>
                        <div class="col-sm-4">
                            <input class="form-control" id="text2" name="text2" value="<?php echo $user['surname'] ?>"placeholder="Surname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text1" class="col-sm-2 control-label">Telephone</label>
                        <div class="col-sm-4">
                            <input class="form-control" id="text3" name="text3" value="<?php echo $user['telephone'] ?>">
                        </div>
                        <label for="text1" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                            <input class="form-control" id="text4" name="text4" value="<?php echo $user['email'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select2" class="col-sm-2 control-label">Citizen</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="select2" ><?php printCitizenship($countries,$user['citizenship']); ?></select>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <input name="param" type="hidden" value="" />
                    <a class="btn btn-primary" href="javascript:void();" onclick="submitform(function(){},'update')">Update</a>
                </div>
            </div>
        </fieldset>
    </form>
</div>

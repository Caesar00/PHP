<script language="javascript" type="text/javascript">
function submitform1()
{
    document.form1.param.value='ok';
    document.form1.submit();
}
</script>
<div class="formflow_h" style="width:80%">
  <?php
if(!isset($submitted))
{
	?>
  <form name="form1" id="form1" method="post" action='staff_MLS.php?cont=MLS&act=submit&page=reject'>
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td>Please give your reason and comment about why you reject this meeting log, it will be sent to the candidate:</td>
      </tr>
      <tr>
        <td><p>
            <textarea name="comments" maxlength='2000' style="width: 99%; height: 200px;"></textarea>
          </p></td>
      </tr>
    </table>
    <p class="buttons"><a href="#" onclick="submitform1()">OK</a>
      <input type="hidden" name="param" value=""/>
    </p>
  </form>
  <?php
}
?>
</div>

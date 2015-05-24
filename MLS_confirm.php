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
  <form name="form1" id="form1" method="post" action='staff_MLS.php?cont=MLS&act=submit&page=confirm'>
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td>Any preparation time (in minutes)?</td>
      </tr>
      <tr>
        <td>
            <input type=text name="ptime" placeholder="00:00:00"\>
        </td>
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

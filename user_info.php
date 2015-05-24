<?php 
if(isset($_SESSION['user']))
{
	$user = $_SESSION['user'];
}
?>
<div class="userinfo">Welcome, 
<?php 
echo($user['salutation'].' '.$user['firstname'].' '.$user['surname'].", "); 
?>
<a href="logout.php">Logout</a>
</div>

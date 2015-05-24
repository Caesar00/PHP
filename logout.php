<!--<a href="logout.php">Logout</a>-->
<?php
    session_start();
    unset($_SESSION);
    session_destroy();
    session_write_close();
    session_start();
    $_SESSION['info'] = "<strong>You've logged out of your account</strong>. Bye!";
    session_commit();
    header('Location: login.php');
    die;
    exit;
?>

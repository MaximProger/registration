<?php
    require "db.php";
?>

<?php if (isset($_SESSION['logged_user'])) : ?>
    Auth!<br>
    Hi, <?php echo $_SESSION['logged_user']->login; ?>!
    <hr>
    <a href="logout.php">LogOut</a>
<?php else : ?>
    <a href="login.php">Auth</a><br>
    <a href="signup.php">SignUp</a>
<?php endif; ?>
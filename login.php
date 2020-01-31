<?php
require "db.php";

    $data = $_POST;
    if(isset($data['do_login'])) {
        $errors = array();
        $user = R::findOne('users', 'login = ?', array($data['login']));
        if ($user) {
            if (password_verify($data['password'], $user->password)) {
                $_SESSION['logged_user'] = $user;
                echo '<div style="color: green;">Successful!</div><hr>';

            } else {
                $errors[] = 'Password is wrong';
            }
        } else {
            $errors[] = 'User is undefind!';
        }

        if(!empty($errors)) {
            echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
        }
    }
?>

<form action="login.php" method="POST">
    <p>
        <strong>Your login:</strong><br>
        <input type="text" name="login" value="<?php echo @$data['login'] ?>">
    </p>
    <p>
        <strong>Your password:</strong><br>
        <input type="password" name="password">
    </p>
    <p>
        <button type="submit" name="do_login">Enter</button>
    </p>
</form>
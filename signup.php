<?php
    require "db.php";

    $data = $_POST;
    if(isset($data['do_signup'])) {
        $errors = array();
        if (trim($data['login']) == '') {
            $errors[] = 'Enter login!';
        }
        if (trim($data['email']) == '') {
            $errors[] = 'Enter email!';
        }
        if ($data['password'] == '') {
            $errors[] = 'Enter password!';
        }
        if ($data['password_2'] != $data['password']) {
            $errors[] = 'Password is wrong';
        }

        if (R::count('users', "login = ?", array($data['login'])) > 0) {
            $errors[] = 'User with that login also exist';
        }

        if (R::count('users', "email = ?", array($data['email'])) > 0) {
            $errors[] = 'User with that email also exist';
        }

        if(empty($errors)) {
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            R::store($user);
            echo '<div style="color: green;">Successful!</div><hr>';

        } else {
            echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
        }
    }
?>

<form action="/signup.php" method="post">
    <p>
        <strong>Your login:</strong><br>
        <input type="text" name="login" value="<?php echo @$data['login'] ?>">
    </p>
    <p>
        <strong>Your Email:</strong><br>
        <input type="email" name="email" value="<?php echo @$data['email'] ?>">
    </p>
    <p>
        <strong>Your password:</strong><br>
        <input type="password" name="password">
    </p>
    <p>
        <strong>Enter your password again:</strong><br>
        <input type="password" name="password_2">
    </p>
    <p>
        <button type="submit" name="do_signup">Registration</button>
    </p>
</form>
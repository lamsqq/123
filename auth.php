<?php
include('connect.php');

if ( !empty($_REQUEST['pass']) and !empty($_REQUEST['login']) ) {
    $login = $_REQUEST['login'];
    $pass = $_REQUEST['pass'];

    $query = 'SELECT * FROM user WHERE login = "'.$login.'" AND pass = "'.$pass.'"';
    $result = mysqli_query($connect, $query);
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)) {
        session_start();
        echo 'ok';
        $_SESSION['auth'] = true; 

        $_SESSION['id'] = $user['id']; 
        $_SESSION['login'] = $user['login'];

        header("Location: index.php");
        exit;
    } else {
        echo 'not ok';
    }
}
?>  

<form method="post">
    login: <input type="text" name="login" /> <br /> 
    pass: <input type="password" name="pass" /> <br />
    <input type="submit" name="submit" value="Login" />
</form> 
<?php

session_start();

require_once '../classes/UserLogic.php';

$result = UserLogic::checkLoginManager();
if ($result) {
    header('Location: manager.php');
    return;
}


$err = $_SESSION;
$_SESSION = array();
session_destroy();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ユーザーログイン</title>
</head>

<body>
    <h2 class="text-muted">管理者ログイン画面</h2>
    <?php if (isset($err['msg'])) : ?>
        <p><?php echo $err['msg']; ?></p>
    <?php endif; ?>
    <div class="form-group w-25">
        <form action="login_manager.php" method="POST">
            <p>
                <label for="username">ユーザー名: </label>
                <input type="text" name="username" class="form-control">
                <?php if (isset($err['username'])) : ?>
            <p><?php echo $err['username']; ?></p>
        <?php endif; ?>
        </p>
        <p>
            <label for="email">Email: </label>
            <input type="email" name="email" class="form-control">
            <?php if (isset($err['email'])) : ?>
        <p><?php echo $err['email']; ?></p>
    <?php endif; ?>
    </p>
    <p>
        <label for="password">パスワード: </label>
        <input type="password" name="password" class="form-control">
        <?php if (isset($err['password'])) : ?>
    <p><?php echo $err['password']; ?></p>
<?php endif; ?>
</p>

<p>
    <input type="hidden" name="manager" value="<?php echo $err['manager']; ?>">
</p>
<p>
    <input type="submit" value="ログイン" class="form-control w-50">
</p>
<a href="signup.php">ユーザー登録はこちら</a>
        </form>
    </div>

</body>

</html>

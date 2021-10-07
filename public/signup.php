<?php

session_start();
require_once '../public/functions.php';
require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if ($result) {
    header('Location: mypage.php');
    return;
}


$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ユーザー登録</title>
</head>

<body>
    <h2 class="text-muted">ユーザー登録画面</h2>
    <?php if (isset($login_err)) : ?>
        <p><?php echo $login_err; ?></p>
    <?php endif; ?>
    <form action="register.php" method="POST">
        <div class="form-group w-25">
            <p>
                <label for="username">ユーザー名: </label>
                <input type="text" name="username" class="form-control">
            </p>
        </div>
        <div class="form-group w-25">
            <p>
                <label for="email">Email: </label>
                <input type="email" name="email" class="form-control">
            </p>
        </div>
        <div class="form-group w-25">
            <p>
                <label for="password">パスワード: </label>
                <input type="password" name="password" class="form-control">
            </p>
        </div>
        <div class="form-group w-25">
            <p>
                <label for="password_conf">パスワード(確認): </label>
                <input type="password" name="password_conf" class="form-control">
            </p>
        </div>
        <p>※パスワードは8~100文字の英数字で設定してください（12345678）</p>
        <div class="form-check">
            <p>
                <label for="manager">管理者フラグ:　 </label>
                <input type="checkbox" name="manager" value=1>管理者
                <input type="checkbox" name="manager" value=0>それ以外
            </p>
        </div>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()) ?>">
        <p>
            <input type="submit" value="新規登録" class="form-control w-25">
        </p>

    </form>
    <h3><a href="login_form.php">ログインはこちら</a></h3>
    <h3><a href="login_form_manager.php">管理者画面はこちら</a></h3>

</body>

</html>

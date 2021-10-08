<?php

session_start();
require_once '../classes/UserLogic.php';
ini_set('display_errors', true);

if (!$logout = filter_input(INPUT_POST, 'logout')) {
    exit('不正なリクエストです！');
}

//Loginしてるか判定し、sessionが切れていたらログインしてくださいとメッセージ出す
$result = UserLogic::checkLogin();
if (!$result) {
    exit('Session is timeout!!' . "\n" . 'Please login again!!');
}

//Logout
UserLogic::logout();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ログアウト</title>
</head>

<body>
    <h2 class="m-3">ログアウト完了</h2>
    <p class="m-3">ログアウト完了しました！</p>
    <p class="m-3">See you next time!</p>
    <a class="m-3" href="signup.php">ユーザー登録画面へ</a>

</body>

</html>

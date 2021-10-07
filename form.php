<?php


$input = $_POST;

$name = $_POST['username'];
$email = $_POST['email'];

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>サブスク登録</title>
</head>

<body>
    <h2 class="text-muted">サブスク登録</h2>
    <div class="form-group w-25">
        <form action="input.php" method="POST">
            <p>サブスク名</p>
            <input type="text" name="sb_name" class="form-control">
            <p>入会日</p>
            <input type="date" name="join_date" class="form-control">
            <p>月額</p>
            <input type="text" name="money" class="form-control">
            <p>リンク</p>
            <input type="text" name="link" class="form-control">
            <input type="hidden" name="username" value="<?php echo $name ?>">
            <input type="hidden" name="email" value="<?php echo $email ?>">
            <input type="submit" value="登録" class="form-control w-50">
        </form>
    </div>
    <!-- <p><a href="index.php">サブスク管理画面に戻る</a></p> -->
    <div class="form-group w-25">
        <form action="index.php" method="post">
            <input type="hidden" name="username" value="<?php echo $name ?>">
            <input type="hidden" name="email" value="<?php echo $email ?>">
            <input type="submit" value="サブスク管理画面に戻る" class="form-control w-50">
        </form>
    </div>

</body>

</html>

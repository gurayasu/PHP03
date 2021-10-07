<?php

require_once('dbc.php');
$id = $_GET['id'];
$result = output_pw($id);

$id = $result['id'];
$sb_name = $result['sb_name'];
$join_date = $result['join_date'];
$money = $result['money'];
$link = $result['link'];

$name = $result['name'];
$email = $result['email'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>サブスク更新</title>
</head>

<body>
    <h2 class="text-muted">サブスク更新</h2>
    <div class="form-group w-25">
        <form action="update_table.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control">
            <p>サブスク名</p>
            <input type="text" name="sb_name" value="<?php echo $sb_name ?>" class="form-control">
            <p>入会日</p>
            <input type="date" name="join_date" value="<?php echo $join_date ?>" class="form-control">
            <p>金額</p>
            <input type="text" name="money" value="<?php echo $money ?>" class="form-control">
            <p>リンク</p>
            <input type="text" name="link" value="<?php echo $link ?>" class="form-control">

            <input type="hidden" name="name" value="<?php echo $name ?>">
            <input type="hidden" name="email" value="<?php echo $email ?>">

            <input type="submit" value="更新" class="form-control w-50">
        </form>
    </div>

    <div class="form-group w-25">
        <form action="index.php" method="post">
            <input type="hidden" name="username" value="<?php echo $name ?>">
            <input type="hidden" name="email" value="<?php echo $email ?>">
            <input type="submit" value="サブスク管理画面に戻る" class="form-control w-50">
        </form>
    </div>

</body>

</html>

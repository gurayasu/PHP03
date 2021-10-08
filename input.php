<?php

require_once('dbc.php');
$input = $_POST;

$name = $_POST['username'];
$email = $_POST['email'];

if (empty($input['sb_name'])) {
    exit('サブスク名を入力してください');
}
if (mb_strlen($input['sb_name']) > 128) {
    exit('サブスク名を128文字以下で入力してください。');
}
if (empty($input['join_date'])) {
    exit('入会日を入力してください。');
}
if (empty($input['money'])) {
    exit('月額を入力してください。');
}
if (empty($input['link'])) {
    exit('リンクを入力してください。');
}

$sql = 'INSERT INTO
            gs_sb_table(id,name,email,sb_name,join_date,money,link)
        VALUES
            (NULL,:name,:email,:sb_name,:join_date,:money,:link)';

$dbh = dbconnect();
$dbh->beginTransaction();

try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':sb_name', $input['sb_name'], PDO::PARAM_STR);
    $stmt->bindValue(':join_date', $input['join_date'], PDO::PARAM_STR);
    $stmt->bindValue(':money', $input['money'], PDO::PARAM_INT);
    $stmt->bindValue(':link', $input['link'], PDO::PARAM_STR);
    $stmt->execute();
    $dbh->commit();
    echo 'サブスク登録が完了しました';
} catch (PDOException $e) {
    $dbh->rollBack();
    exit($e);
}

?>
<!--
<p><a href="index.php">サブスク管理画面に戻る</a></p> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ログイン完了</title>
</head>

<body>

    <div class="m-3">
        <form action="index.php" method="post">
            <input type="hidden" name="username" value="<?php echo $name ?>">
            <input type="hidden" name="email" value="<?php echo $email ?>">
            <input class="form-control w-25 m-3" type="submit" value="サブスク管理画面に戻る">
        </form>
    </div>

</body>

</html>

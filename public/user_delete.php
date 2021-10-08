<?php

$id = $_GET['id'];

try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'all', '');
} catch (PDOException $e) {
  exit('DbConnectError:' . $e->getMessage());
}

$sql = 'DELETE FROM gs_login_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);    //更新したいidを渡す
$status = $stmt->execute();

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

  <p class="m-3">ユーザー削除完了しました</a></p>
  <p class="m-3"><a href="manager.php">ユーザー管理画面に戻る</a></p>

</body>

</html>

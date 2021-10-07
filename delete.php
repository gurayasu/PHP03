<?php

require_once('dbc.php');
$id = $_GET['id'];

$result = output_pw($id);
$name = $result['name'];
$email = $result['email'];

$dbh = dbconnect();

$sql = 'DELETE FROM gs_sb_table WHERE id=:id';

$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
$stmt->execute();
echo 'サブスク削除が完了しました。' . PHP_EOL;
echo 'サイトでの退会手続きもお忘れなく！';


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

  <div class="form-group w-25">
    <form action="index.php" method="post">
      <input type="hidden" name="username" value="<?php echo $name ?>">
      <input type="hidden" name="email" value="<?php echo $email ?>">
      <input type="submit" value="サブスク管理画面に戻る" class="form-control w-50">
    </form>
  </div>

</body>

</html>

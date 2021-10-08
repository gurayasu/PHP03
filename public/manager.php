<?php

try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'all', '');
} catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
}

//データ抽出SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_login_table");
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTD-8');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ユーザー管理</title>
</head>

<body>
    <h2 class="text-muted m-3">ユーザー管理</h2>
    <h4 class="m-3">登録済みユーザー登録一覧</h4>
    <table class="table table-bordered w-50 m-3">
        <tr>
            <th>ユーザー名</th>
            <th>email</th>
            <th>管理者フラグ</th>
        </tr>
        <?php foreach ($result as $column) : ?>
            <tr>
                <td><?php echo h($column['name']) ?></td>
                <td><?php echo h($column['email']) ?></td>
                <td><?php echo h($column['manager']) ?></td>
                <td><a href="user_delete.php?id=<?php echo $column['id'] ?>" onclick="return confirm('削除してよろしいですか？')">強制削除</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a class="m-3" href="signup.php">ユーザー登録画面へ</a>
</body>

</html>

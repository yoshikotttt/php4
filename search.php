<?php
ini_set("display_errors", 1);

function h($val)
{
    return  htmlspecialchars($val, ENT_QUOTES);
}

require_once('config.php');

$keyword = $_POST["keyword"];

// 1.DB接続します 
try {
    //Password:MAMP='root',XAMPP='' //さくらのパスワードが必要
    $pdo = new PDO("mysql:dbname={$database_name};charset=utf8;host={$host}", $user_id, $database_password); //$pdoにデータが入ってくる
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}


//２．データ取得SQL作成
$sql = "SELECT * FROM $table_name WHERE title LIKE '%$keyword%'";  //sqlを作って下で代入できるようにしている
//もしデータが大量にある場合は上記にリミットをつけたりする
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':keyword', $keyword, PDO::PARAM_STR);
$status = $stmt->execute();

//３.データ表示
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("データが見つかりませんでした" . $error[2]);
}


//全データ取得 オブジェクトとして入ってくる データベースに接続して持ってくる
$row =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONに値を渡す場合に使う 基本はencodeまでやる...?
$json = json_encode($row, JSON_UNESCAPED_UNICODE);

// print_r($row);

$row = $keyword[0];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recipe</title>
    <style>
        body {
            background-color: #fcecea;
        }
    </style>
</head>

<body>
    <a href="index.php">TOP</a>
    <h2>検索結果</h2>
    <?php foreach ($values as $v) { ?>

        <h2><?= $v["id"] ?></h2>
        <a href="select.php?id=<?= $v["id"] ?>">
            <div class="box">
                <div class="title">レシピ名：<?= h($v["title"]) ?></div>
                <div class="size">サイズ：<?= h($v["height"]) ?>×<?= $v["width"] ?>×<?= $v["depth"] ?></div>
                <div class="date">登録日：<?= h($v["indate"]) ?></div>
            </div>
        </a>

    <?php } ?>

</body>

</html>
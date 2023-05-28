<?php
ini_set("display_errors",1);

function h($val){
    return  htmlspecialchars($val,ENT_QUOTES);
    }

require_once('config.php');

$target_id = $_GET["id"];

// 1.DB接続します 
try {
    //Password:MAMP='root',XAMPP='' //さくらのパスワードが必要
    $pdo = new PDO("mysql:dbname={$database_name};charset=utf8;host={$host}", $user_id, $database_password); //$pdoにデータが入ってくる
  

} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}


//２．データ取得SQL作成
$sql = "SELECT * FROM $table_name WHERE id=:target_id";  //sqlを作って下で代入できるようにしている
//もしデータが大量にある場合は上記にリミットをつけたりする
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':target_id', $target_id, PDO::PARAM_INT);
$status = $stmt->execute();

//３.データ表示
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
}

//３．データ表示
//全データ取得 オブジェクトとして入ってくる データベースに接続して持ってくる
$target_data =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONに値を渡す場合に使う 基本はencodeまでやる...?
$json = json_encode($target_data, JSON_UNESCAPED_UNICODE);

// print_r($target_id);

$row = $target_data[0];
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
    <div class="wrapper2">
        <div class="title">レシピ名：<?= h($row["title"]); ?></div>
        <div class="material">材料１：<?= h($row["material"]); ?></div>
        <div class="amount">材料２：<?= h($row["amount"]); ?></div>
        <div class="recipe">作り方：<?= h($row["recipe"]); ?></div>
        <div class="link">参考サイト：<?= h($row["link"]); ?></div>
        <div class="size">サイズ：<?= h($row["height"]); ?>×<?= h($row["width"]); ?>×<?= h($row["depth"]); ?></div>
        <div class="date">登録日：<?= h($row["indate"]); ?></div>
    </div>

</body>

</html>
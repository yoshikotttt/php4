<?php

require_once('config.php');

//POSTデータ取得
// $image = $_POST["image"];
$title = $_POST["title"];
$material = $_POST["material"];
$amount = $_POST["amount"];
$height = $_POST["height"];
$width = $_POST["width"];
$depth = $_POST["depth"];
$recipe = $_POST["recipe"];
$link = $_POST["link"];




//2. DB接続します (どこを変えるかをわかっていれば大丈夫)
try {
    //Password:MAMP='root',XAMPP='' //さくらのパスワードが必要
    $pdo = new PDO("mysql:dbname={$database_name};charset=utf8;host={$host}", $user_id, $database_password); //$pdoにデータが入ってくる
  } catch (PDOException $e) {
      exit('DBConnectError:' . $e->getMessage());
  }

//３．データ登録SQL作成  セレクト文    バインドバリューとプリペアでデータを無効化したりして守る 変数入れない！
//ここが一番大変
$sql  = "INSERT INTO $table_name(title,material,amount,height,width,depth,recipe,link,indate)VALUES(:title,:material,:amount,:height,:width,:depth,:recipe,:link,sysdate());";
$stmt = $pdo->prepare($sql); //prepareにINSERTのデータを渡したところ
// 無効化した値を渡すあぶないデータを無効化して橋渡ししてくれる
// $stmt->bindValue(':image',   $image,  PDO::PARAM_LOB);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':title',  $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':material',    $material,   PDO::PARAM_STR);
$stmt->bindValue(':amount',    $amount,   PDO::PARAM_STR);
$stmt->bindValue(':height',    $height,   PDO::PARAM_INT);
$stmt->bindValue(':width',    $width,   PDO::PARAM_INT);
$stmt->bindValue(':depth',    $depth,   PDO::PARAM_INT);
$stmt->bindValue(':recipe',    $recipe,   PDO::PARAM_STR);
$stmt->bindValue(':link',    $link,   PDO::PARAM_STR);


//statusの中には bool=trueかfalseしか返ってこない
$status = $stmt->execute();

//４．データ登録処理後 
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
  }else{
    //５．index.phpへリダイレクト    :の後、index.phpの前にはスペースが必須
    header("Location: index.php");
    exit();
  
  }
  ?>
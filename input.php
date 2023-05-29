<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #fcecea;
            color: #ee817b;
            
        }

        input {
            font-size: 22px;
        }

        .box1 input {
            width: 300px;

        }


        .box3 {
            display: flex;
            flex-direction: column;
        }

        .box3 input {
            width: 150px;
        }




        .box2 input {
            width: 150px;
        }

        .nice-textbox {
            border: none;
            border-radius: 5px;
            height: 40px;
            color: #a0a0a0;
            outline: none;
        }

        .box4 textarea {
            width: 350px;
            margin-bottom: 20px;
            outline: none;
            border: none;
            border-radius: 5px;
            color: #a0a0a0;
        }

        .box5 input {
            width: 350px;
            margin-bottom: 20px;
            font-size: 17px;
        }
    </style>
</head>

<body>
    <a href="index.php">TOP</a>
    <div class="container">
        <form action="insert.php" method="post">
            <!-- <div class="box1">
            <h2>画像を入れよう</h2>
            <input type="file" name="image" accept="image/*">
        </div> -->
            <div class="box1">
                <h1>レシピ名</h1>
                <input class="nice-textbox" type="text" name="title">
            </div>
            <div class="box2">
                <h2>材料</h2>
                <input class="nice-textbox" type="text" name="material">
                <input class="nice-textbox" type="text" name="amount">
            </div>
            <div class="box3">
                <h2>出来上がりサイズ</h2>
                縦 <input class="nice-textbox" type="text" name="height"><br />
                横 <input class="nice-textbox" type="text" name="width"><br />
                マチ<input class="nice-textbox" type="text" name="depth">
            </div>
            <div class="box4">
                <h2>作り方</h2>
                <textarea  name="recipe" rows="10" cols="50"></textarea>
            </div>
            <div class="box5">
                <h2>参考リンク</h2>
                <input class="nice-textbox" type="text" name="link">
            </div>
            <div class="box2">
                <input class="nice-textbox" type="submit" value="登録">
            </div>


        </form>

    </div>

</body>

</html>
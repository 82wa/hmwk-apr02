<?php //Apacheの初期設定では.html上でphpを動かせないので注意（設定替えればいけるけどセキュリティ上の問題でできなくしてるみたいなのでしないことにする）?>
<?php
  // 遷移前のphpファイルから受け取りたい変数をGETしておく（使いたいものだけ）
  $user_id = $_GET["user_id"];
  $user_name = $_GET["user_name"];
  $start = $_GET["start"];
  $permission = $_GET["permission"];
  $order_user = $_GET["user_id"];
  ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>add</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class="top">
<h2><?php echo "$user_name"; ?>さん、こんにちは（権限：<?php echo $permission; ?>, ID：<?php echo $user_id; ?>）</h2>
</div>

<form action="add.php" method="get">
        <!--name-->
        <label for="book_type">書籍名：</label>
        <input type="text" name="book_title" style="width: 300px;">
        <p></p>
        <!--type-->
        <label for="book_type">種別：</label>
        <select name='book_type'>
            <option value="0">ジャンル</option>
            <option value="1">小説</option>
            <option value="2">ノンフィクション</option>
            <option value="3">漫画</option>
            <option value="4">学習参考書</option>
            <option value="5">専門書</option>
            <option value="6">自己啓発本</option>
            <option value="7">画集・写真集</option>
            <option value="8">料理本</option>
            <option value="9">旅行ガイド</option>
            <option value="10">詩</option>
            <option value="11">エッセイ</option>
            <option value="12">業界紙</option>
        </select>
        <p></p>
        <!--price-->
        <label for="book_price">価格：</label>
        <input type="text" name="book_price">
        <p></p>
        <!--order_date-->
        <!--遷移先のphpで取得するのでここでは何もしない-->

        <!--order_status-->
        <input type="hidden" name="order_status" value="3">
        
        <!--order_user-->
        <input type="hidden" name="order_user" value="<?php echo $order_user; ?>">
    
        <!--遷移先のphpで使うのでここではいらないんだけど書いておく-->
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
        <input type="hidden" name="start" value="<?php echo $start; ?>">
        <input type="hidden" name="permission" value="<?php echo $permission; ?>">

        <input type="submit" name="addBtn" value="追加">
    </form>
    
</body>
</html>

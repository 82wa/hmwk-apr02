<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>viewSearch_tpl</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
  
<div class="top">
<h2><?php echo "$user_name"; ?>さん、こんにちは（権限：<?php echo $permission; ?>, ID：<?php echo $user_id; ?>）</h2>
</div>

<!--上部ボタン群-->
<div class="btn">
<!--検索-->
<form action="search.php" method="get">
<input type="text" name="book_title" value="<?php echo $book_title; ?>">
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
<input type="submit" name="searchBtn" value="検索">
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
<input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
<input type="hidden" name="start" value="0"><!--何ページか進んだ(戻った)状態で検索押しても検索結果は1ページ目から開始させる-->
<input type="hidden" name="permission" value="<?php echo $permission; ?>">
<!--ボタンを押してbook_typeやbook_titleの中身(？)が生まれるのでこの時点で<input type=hidden～は書かない-->
</form>

<!--追加-->
<form action="ViewAdd_tpl.php" method="get">
<input type="submit" name="addBtn" value="追加">
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
<input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
<input type="hidden" name="start" value="<?php echo $start; ?>">
<input type="hidden" name="permission" value="<?php echo $permission; ?>">
</form>

<!--変更…ここで削除も行う-->
<!--ラジオボタンやボタンはformの中でしか有効になれないので注意-->
<form action="ViewUpdate_Select.php" method="get">
<?php echo "<input type=\"submit\" name=\"updateBtn\" value=\"修正\"";
//修正ボタンを選択不可の状態にする　権限が無い[2]…選択不可
if( $permission == 2 ) echo "disabled";
echo ">";?>
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
<input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
<input type="hidden" name="start" value="<?php echo $start; ?>">
<input type="hidden" name="permission" value="<?php echo $permission; ?>">
<input type="hidden" name="pri_key" value="<?php echo $pri_key; ?>">
</div>
<!--書籍情報等のSQL表示部分-->
<div id="selectView">
<!--テーブルの見出し-->
<table class="tb">
   <tr>
     <th width="10px"></th>
     <th width="1000px">書籍名</th>
     <th width="250px">ジャンル</th>
     <th width="200px">価格</th>
     <th width="200px">ステータス</th>
     <th width="200px">登録日</th>
     <th width="200px">登録者</th>
   </tr>
<!--書籍情報部分-->
<?php
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>";
            echo "<input type=\"radio\" name=\"pri_key\" value=\"{$row["product_id"]}\"";
 
            //ラジオボタンを選択必須の状態にする…権限ある人[1]向け
            if( $permission == 1 ) echo "required";

            //権限によってラジオボタンを選択不可の状態にする
            //権限が無い[2]…選択不可
            if( $permission == 2 ) echo "disabled";
     
            echo ">";
            echo "</td>";
            echo "<td>" . ($row["product_name"]) . "</td>"; //書籍名
            echo "<td>" . ($row["type_name"]) . "</td>";    //ジャンル
            echo "<td>" . ($row["price"]) . "円" . "</td>"; //価格
            echo "<td>" . ($row["status"]) . "</td>";       //ステータス
            echo "<td>" . ($row["order_date"]) . "</td>";   //登録日
            echo "<td>" . ($row["user_name"]) . "</td>";    //登録者
            
            echo "</tr>";
        }
?>
 </table>
</div>
</form>

<!--下部ボタン群-->
<div class="btn">
<!--fromのaction先のphpファイルに受け渡したい変数はhiddenで記入しておく-->

<!--ログイン画面ページ-->
<form action="login.html" method="get">
<input type="submit" name="loginBtn" value="ログイン画面">
</form>

<!--次のページ-->
<form action="search.php" method="get">
<input type="submit" name="nextBtn" value="次へ">
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
<input type="hidden" name="permission" value="<?php echo $permission; ?>">
<input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
<input type="hidden" name="start" value="<?php echo $start+5; ?>">
<!--検索条件の保持-->
<input type="hidden" name="book_title" value="<?php echo $book_title; ?>">
<input type="hidden" name="book_type" value="<?php echo $book_type; ?>">
</form>

<!--前のページ-->
<form action="search.php" method="get">
<input type="submit" name="previousBtn" value="前へ">
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
<input type="hidden" name="permission" value="<?php echo $permission; ?>">
<input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
<!--検索条件の保持-->
<input type="hidden" name="book_title" value="<?php echo $book_title; ?>">
<input type="hidden" name="book_type" value="<?php echo $book_type; ?>">
<!--前に戻りすぎない用のif-->
<?php                                                               
if ($start != 0) {$start -= 5;}
?>
<input type="hidden" name="start" value="<?php echo $start; ?>">
</form>
</div>

</body>
</html>
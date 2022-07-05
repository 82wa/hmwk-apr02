<!-- ボタンを横並びにする：https://teratail.com/questions/51456 -->
<!-- ラジオボタンのお話： https://codeforfun.jp/reference-html-tag-input-type-radio/-->
<!-- 一つのフォーム内にあるどのボタンが押されたかの判定：https://moewe-net.com/php/which-submit-button-->
<!-- inputタグのValue属性の初期値について：https://webukatu.com/wordpress/blog/39366/-->
<!-- かわいい見出し： https://www.webtan.cc/wp/htmlcssjquery-%E3%82%B3%E3%83%BC%E3%83%87%E3%82%A3%E3%83%B3%E3%82%B0/%E3%80%90css%E3%80%91%E7%B7%9A%E3%81%AB%E9%87%8D%E3%81%AA%E3%82%8B%E8%A6%8B%E5%87%BA%E3%81%97%E3%82%BF%E3%82%A4%E3%83%88%E3%83%AB%E4%BB%98%E3%81%8D%E3%81%AE%E6%9E%A0%E7%B7%9A%E3%81%A7%E5%9B%B2/-->
<!-- かわいい見出し：https://pa-tu.work/category/1?page=2 -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>viewSelect_tpl</title>
    <link rel="stylesheet" href="style.css">
    <style>
    body{
        margin: 30px 20px 30px 40px;
    }
    #selectView {
        margin: 20px 0px 20px 0px;
    }
    .btn form {
	    display: inline-block;
    }
    .top {
        margin-bottom: 30px;
    }
    </style>
    <style>
    h2 {
        position: relative;
        padding: 10px;
        box-shadow: 0 0 0 7px #D9695F;
        border: 2px dashed #40271E;
        border-radius: 30px;
        background-color: #D9695F;
        color: #ffffff;
        font-size: 16px;
        font-weight:normal;
        width: 400px;
    }
</style>
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
<input type="hidden" name="start" value="<?php echo $start; ?>">
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
<?php
        foreach ($result as $row) {
            echo "<input type=\"radio\" name=\"pri_key\" value=\"{$row["product_id"]}\"";
 
            //一番左のラジオボタンを選択中の状態にする…が、一番上ってどう表現するんだ？
            //if( ($row["product_id"] % 5) == 0 ) echo "checked";
 
            
            //ラジオボタンを選択必須の状態にする…権限ある人[1]向け
            if( $permission == 1 ) echo "required";

            //権限によってラジオボタンを選択不可の状態にする
            //権限が無い[2]…選択不可
            if( $permission == 2 ) echo "disabled";
     
            echo ">";
            //echo '<input type="radio" name="pri_key" value="'.$row["product_id"].'">'; // 主キーをvalueにつっこんでいる
            //echo "　";
            echo ($row["name"]);
            echo "　";
            echo ($row["price"]);
            echo "円";
            echo "<br/>";
        }
?>
</div>
</form>

<!--下部ボタン群-->
<div class="btn">
<!--fromのaction先のphpファイルに受け渡したい変数はhiddenで記入しておく-->

<!--前のページ-->
<form action="select.php" method="get">     <!-- select.phpのところが＄_GETなのでmethodもgetとする -->
<input type="submit" name="nextBtn" value="前へ">
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
<input type="hidden" name="permission" value="<?php echo $permission; ?>">
<input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
<input type="hidden" name="start" value="<?php echo $start+5; ?>">  <!--　※いつかやりたい…+5だと無限に進んでしまうのでmaxで最大値取った方が良い気がする-->
</form>

<!--次のページ-->
<form action="select.php" method="get">     <!-- select.phpのところが＄_GETなのでmethodもgetとする -->
<input type="submit" name="previousBtn" value="次へ">
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
<input type="hidden" name="permission" value="<?php echo $permission; ?>">
<input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
<!--前に戻りすぎない用のif-->
<?php                                                               
if ($start != 0) {$start -= 5;}
?>
<input type="hidden" name="start" value="<?php echo $start; ?>">
</form>
</div>

</body>
</html>
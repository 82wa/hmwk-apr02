<?php
  // 遷移前のphpファイルから受け取りたい変数をGETしておく（使いたいものだけ）
  $user_id = $_GET["user_id"];
  $user_name = $_GET["user_name"];
  $start = $_GET["start"];
  $permission = $_GET["permission"];
  $order_user = $_GET["user_id"];
  $pri_key = $_GET["pri_key"];

  //なぜか書かないと上手くいく遷移前の変数たち　actionではなくrequire_once経由だから？？？
  //$book_title = $_GET["book_title"];
  //$book_type = $_GET["book_type"];
  //$book_price = $_GET["book_price"];
  //$order_status = $_GET["order_status"];
  //$order_date = $_GET["order_date"];
  //
  ?>

<!DOCTYPE html>
  <html lang="ja">
  <head>
      <meta charset="UTF-8">
      <title>update</title>
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
      <script>
    function confirm_form() {
    var select = confirm("本当に実行しますか？");
    return select;
    }
    </script>
  </head>
  <body>
<?php
//echo $pri_key;
//echo "</br>";
//echo $book_title;
//echo "</br>";
//echo $book_type;
//echo "</br>";
//echo $book_price;
//echo "</br>";
//echo $order_status;
//echo "</br>";
//echo $order_date;
?>
  <div class="top">
  <h2><?php echo "$user_name"; ?>さん、こんにちは（権限：<?php echo $permission; ?>, ID：<?php echo $user_id; ?>）</h2>
  </div>
  
  <form action="update.php" method="get" onsubmit="return confirm_form()">
          <!--name-->
          <label for="book_title">書籍名：</label>
          <input type="text" name="book_title" value="<?php echo $book_title;?>">
          <p></p>
          <!--type-->
          <label for="book_type">種別：</label>
          <select name='book_type'>
              <option value="<?php echo $book_type;?>">ジャンル</option>    <!--ここベタ打ちだからジャンル名がかえられない　どうしようもない-->
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
          <input type="text" name="book_price" value="<?php echo $book_price;?>">
          <p></p>
          <!--order_date　でも普通登録日操作するか？-->
          <label for="order_date">登録日：</label>
          <input type="text" name="order_date" value="<?php echo $order_date;?>">
          <p></p>

          <!--order_status-->
          <label for="order_status">ステータス：</label>
          <input type="text" name="order_status" value="<?php echo $order_status;?>">
          <p></p>
          
          <!--order_user-->
          <label for="order_user">登録者：</label>
          <input type="text" name="order_user" value="<?php echo $order_user;?>">
          <p></p>
      
          <!--遷移先のphpで使うのでここではいらないんだけど書いておく-->
          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
          <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
          <input type="hidden" name="start" value="<?php echo $start; ?>">
          <input type="hidden" name="permission" value="<?php echo $permission; ?>">
          <input type="hidden" name="pri_key" value="<?php echo $pri_key; ?>">
  
          <input type="submit" name="updateBtn" value="修正">
          <?php echo "<input type=\"submit\" name=\"deleteBtn\" value=\"削除\"";
            //削除ボタンを選択不可の状態にする　権限が無い[2]…選択不可
            if( $permission == 2 ) echo "disabled";
            echo ">";
          ?>
      </form>
  </body>
  </html>
  
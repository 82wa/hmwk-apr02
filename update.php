<?php
  // 遷移前のphpファイルから受け取りたい変数をGETしておく（使いたいものだけ）
  $user_id = $_GET["user_id"];
  $user_name = $_GET["user_name"];
  $start = $_GET["start"];
  $permission = $_GET["permission"];
  $order_user = $_GET["user_id"];
  $pri_key = $_GET["pri_key"];

  //なぜか書かないと上手くいく遷移前の変数たち　actionではなくrequire_once経由だから？？？
  $book_title = $_GET["book_title"];
  $book_type = $_GET["book_type"];
  $book_price = $_GET["book_price"];
  $order_status = $_GET["order_status"];
  $order_date = $_GET["order_date"];
  

if (isset($_GET['updateBtn']))
{
try {
  // データベースに接続
  $pdo = new PDO(
  // ホスト名、データベース名
  'mysql:host=localhost;dbname=order;charset=utf8;',
  // ユーザー名
  'root',
  // パスワード
  '',
  // レコード列名をキーとして取得させる
  [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
  );
          $query = 'UPDATE products SET type = :type, name = :name, price = :price, order_date = :order_date, order_status = :order_status, order_user = :order_user WHERE product_id = :product_id';
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':product_id', $pri_key, PDO::PARAM_INT);
          $stmt->bindParam(':type', $book_type, PDO::PARAM_INT);
          $stmt->bindParam(':name', $book_title, PDO::PARAM_STR);
          $stmt->bindParam(':price', $book_price, PDO::PARAM_INT);
          $stmt->bindParam(':order_date', $order_date, PDO::PARAM_STR);
          $stmt->bindParam(':order_status', $order_status, PDO::PARAM_INT);
          $stmt->bindParam(':order_user', $order_user, PDO::PARAM_STR);
          $stmt->execute();
          //echo "できてるよお";
          
          //変更後、5件だけ検索して最初のページに戻る
          $query = 'select * from products limit :start, 5';
          $sstmt = $pdo->prepare($query);
          $sstmt->bindParam(':start', $start, PDO::PARAM_INT); // PDO::PARAM_INTやPDO::PARAM_STRなどtypeを指定しないとエラーになる
          $sstmt->execute();
          $result = $sstmt->fetchAll();
          require_once 'viewSelect_tpl.php';
    

  }
  catch (PDOException $e) {
    //例外が発生したら無視する
    require_once 'exception_tpl.php';
    echo $e->getMessage();
    exit();
 }
}
if (isset($_GET['deleteBtn']))
{
  try {
  // データベースに接続
  $pdo = new PDO(
  // ホスト名、データベース名
  'mysql:host=localhost;dbname=order;charset=utf8;',
  // ユーザー名
  'root',
  // パスワード
  '',
  // レコード列名をキーとして取得させる
  [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
  );
  $query = 'DELETE FROM products WHERE product_id = :product_id';
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':product_id', $pri_key, PDO::PARAM_INT);
  $stmt->execute();
  //echo "消すぞー－－－！";

  //削除後、5件だけ検索して最初のページに戻る
  $query = 'select * from products limit :start, 5';
  $sstmt = $pdo->prepare($query);
  $sstmt->bindParam(':start', $start, PDO::PARAM_INT); // PDO::PARAM_INTやPDO::PARAM_STRなどtypeを指定しないとエラーになる
  $sstmt->execute();
  $result = $sstmt->fetchAll();
  require_once 'viewSelect_tpl.php';


}
catch (PDOException $e) {
  //例外が発生したら無視する
  require_once 'exception_tpl.php';
  echo $e->getMessage();
  exit();
}
}
?>

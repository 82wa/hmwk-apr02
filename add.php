<?php
  // 遷移前のphpファイルから受け取りたい変数をGETしておく（使いたいものだけ）
  $user_id = $_GET["user_id"];
  $order_user = $_GET["order_user"];
  $user_name = $_GET["user_name"];
  $start = $_GET["start"];
  $permission = $_GET["permission"];
  $book_title = $_GET["book_title"];
  $book_type = $_GET["book_type"];
  $book_price = $_GET["book_price"];
  $order_status = $_GET["order_status"];
  $order_date = time() ;
  $order_date = date( "Y-m-d" , $order_date );

  if($book_type == 0 || empty($book_title) || empty($book_price)) {
    echo "[!] 登録情報に空欄があります。";
    require_once 'ViewAdd_tpl.php';
  }else {

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
          
          $query = 'INSERT INTO products(product_id, type, name, price, order_date, order_status, order_user)
          VALUES(0, :type, :name, :price, :order_date, :order_status, :order_user)';
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':type', $book_type, PDO::PARAM_INT);
          $stmt->bindParam(':name', $book_title, PDO::PARAM_STR);
          $stmt->bindParam(':price', $book_price, PDO::PARAM_INT);
          $stmt->bindParam(':order_date', $order_date, PDO::PARAM_STR);
          $stmt->bindParam(':order_status', $order_status, PDO::PARAM_INT);
          $stmt->bindParam(':order_user', $order_user, PDO::PARAM_STR);
          $stmt->execute();
          
          //挿入後、5件だけ検索して最初のページに戻る
          require_once 'Select.php';
      
  
    }
    catch (PDOException $e) {
      //例外が発生したら無視する
      require_once 'exception_tpl.php';
      echo $e->getMessage();
      exit();
   }
  }
  
  ?>
  
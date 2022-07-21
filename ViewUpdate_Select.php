<?php
  // 遷移前のphpファイルから受け取りたい変数をGETしておく（使いたいものだけ）
  $user_id = $_GET["user_id"];
  $user_name = $_GET["user_name"];
  $start = $_GET["start"];
  $permission = $_GET["permission"];
  $pri_key = $_GET["pri_key"];

  //編集・削除対象のものを検索する
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
          $query = 'select * from products where product_id = :product_id';
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':product_id', $pri_key, PDO::PARAM_INT); // PDO::PARAM_INTやPDO::PARAM_STRなどtypeを指定しないとエラーになる
          $stmt->execute();
          $result = $stmt->fetchAll();

          $pri_key = $result[0]["product_id"];
          $book_type = $result[0]["type"];
          $book_title = $result[0]["name"];
          $book_price = $result[0]["price"];
          $order_date = $result[0]["order_date"];
          $order_status = $result[0]["order_status"];
          $order_user = $result[0]["order_user"];

          require_once 'ViewUpdate_tpl.php';
      
    }
    catch (PDOException $e) {
      //例外が発生したら入力しなおし
      echo "[!] 登録できない値が入力されています";
      require_once 'ViewAdd_tpl.php';
      echo $e->getMessage();
      exit();
   }
  ?>


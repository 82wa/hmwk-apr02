<?php
  // 遷移前のphpファイルから受け取りたい変数をGETしておく（使いたいものだけ）
  $user_id = $_GET["user_id"];
  $user_name = $_GET["user_name"];
  $start = $_GET["start"];
//  $start = 0;
  $permission = $_GET["permission"];
  $book_title = $_GET["book_title"];
  $book_type = $_GET["book_type"];

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

        echo $book_title;
        echo '</br>';
        echo $book_type;
        echo '</br>';
        echo $start;


          $query = 'SELECT * FROM products WHERE 1=1';
          if($book_title) $query .= ' AND name LIKE :book_title';
          if($book_type) $query .= ' AND type = :book_type';
          $query .= ' limit :start, 5';

          echo $query;

          $stmt = $pdo->prepare($query);
          
          if($book_type) $stmt -> bindValue(':book_type', $book_type, PDO::PARAM_INT);
          if($book_title) $stmt -> bindValue(':book_title', '%'.$book_title.'%', PDO::PARAM_STR);
          $stmt->bindValue(':start', $start, PDO::PARAM_INT); // PDO::PARAM_INTやPDO::PARAM_STRなどtypeを指定しないとエラーになる
          $stmt->execute();
          $result = $stmt->fetchAll();
          require_once 'viewSelect_tpl.php';
      
  
    }
    catch (PDOException $e) {
      //例外が発生したら無視する
      require_once 'exception_tpl.php';
      echo $e->getMessage();
      exit();
   }
  
  ?>
  
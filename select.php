<?php
  // 遷移前のphpファイルから受け取りたい変数をGETしておく（使いたいものだけ）
  $user_id = $_GET["user_id"];
  $user_name = $_GET["user_name"];
  $start = $_GET["start"];
  $permission = $_GET["permission"];

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
          //5件だけ検索
          //phpはテーブル名.を理解しないらしく複数テーブルに同名の属性名があるときasを付けないと一つしか出てこない(テーブル.で区別しない)
          $query = 'select
          product_id,
          name as product_name,
          ty.type_name,
          price,
          order_date,
          stat.status,
          usr.user_name
          from
          products as prod
          inner join status as stat 
          on prod.order_status = stat.status_id
          inner join type as ty
          on prod.type = ty.type_id
          inner join user as usr
          on prod.order_user = usr.user_id
          order by prod.product_id desc
          limit :start, 5';
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':start', $start, PDO::PARAM_INT); // PDO::PARAM_INTやPDO::PARAM_STRなどtypeを指定しないとエラーになる
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
  
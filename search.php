<?php
  // 遷移前のphpファイルから受け取りたい変数をGETしておく（使いたいものだけ）
  $user_id = $_GET["user_id"];
  $user_name = $_GET["user_name"];
  $start = $_GET["start"];
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

          //$query = 'SELECT * FROM products WHERE 1=1';
          //nameという列がテーブル名を.で表記してもダブってると認識して出てこない？みたいなので全部asで別名を付ける
          //$query = 'select prod.product_id as product_id, prod.name as name, prod.price as price, prod.order_date as order_date, stat.status as status, type.name as type_name, user.name as user_name from products as prod inner join status as stat on prod.order_status = stat.status_id inner join type on prod.type = type.type_id inner join user on prod.order_user = user.user_id WHERE (1=1)';
          //別テーブルにダブってる属性名があると結合したとき上手く表示できないことがあるので注意
          //出すだけならasで別名付けたら出せるけどwhereとかで絞ってから出すのは無理っぽい(whereはselectより前で実行されるので別名付けても機能しない)
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
          where 1=1';
          if($book_title) $query .= ' AND name LIKE :book_title';
          if($book_type) $query .= ' AND type = :book_type';
          $query .= ' order by prod.product_id desc limit :start, 5';

          $stmt = $pdo->prepare($query);
          if($book_type) $stmt -> bindValue(':book_type', $book_type, PDO::PARAM_INT);
          if($book_title) $stmt -> bindValue(':book_title', '%'.$book_title.'%', PDO::PARAM_STR);
          $stmt->bindValue(':start', $start, PDO::PARAM_INT); // PDO::PARAM_INTやPDO::PARAM_STRなどtypeを指定しないとエラーになる
          
          $stmt->execute();
          $result = $stmt->fetchAll();

          if($book_type || $book_title) {
            require_once 'viewSearch_tpl.php';
          }else{
            require_once 'viewSelect_tpl.php';
          }
          
    }
    catch (PDOException $e) {
      //例外が発生したら無視する
      require_once 'exception_tpl.php';
      echo $e->getMessage();
      exit();
   }
  
  ?>
  
<?php //phpでは変数名の前に$をつける ?>
<?php //phpでは””で囲むと変数が置換される…''だと置換されない ?>
<?php //GETしてきたものが=左辺の変数に入る ?>
<?php
  $user_id = $_GET["user_id"];
  $password = $_GET["password"];
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

    //SQLクエリ作成・・・:変数名のところに下のbindParamで指定したものが入る（bindParamでSQLインジェクションを防ぐ）
    $query = 'select * from user where user_id = :user_id and password = :password';

    //SQL文をセット
    $stmt = $pdo->prepare($query);

    //バインド・・・↑で書いたsql文の変数部分に値を入れている、型の指定をしなければならない場合がある（今回は無し）
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':password', $password);

    //SQL文を実行
    $stmt->execute();

    //実行結果のフェッチ
    $result = $stmt->fetchAll();
    if(empty($result)){
        require_once 'login.html';
    } else {
        $user_name = $result[0]["user_name"];
        $permission = $result[0]["permission"];
        //5件だけ検索
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

  }
  catch (PDOException $e) {
    //例外が発生したら無視する
    require_once 'exception_tpl.php';
    echo $e->getMessage();
    exit();
 }

 ?>

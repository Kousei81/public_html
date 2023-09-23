<?php
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザ名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$name = "こうせい";
$comment = "ありがとうございます！";
$sql = "INSERT INTO tbtest (name, comment) VALUES (:name, :comment)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":name", $name, PDO::PARAM_STR);
$stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
$stmt->execute();
//insert into テーブル名 (列名) values (値);は列名に対応する値を追加する。
//query,prepare,executeはどれもsql文を実行するメソッド。
//変数をSQL文に組み込む必要がある場合はprepareとexecuteを使う。
//そのほかの場合でも基本的にprepareとexecuteを使えばOK。
//固定SQLを実行する場合はqueryを使う。
//bindParamは第二引数が変数でないとだめ、bindValueは変数でも直接値でもどちらでもいい。
//bindParamは第二引数が数値型でも文字型に変わる。
//bindParamはexecuteまでに値を変えてもOK、bindValueはexecuteまでに値を変えられない。
//$変数 = PDOから作成したインスタンスを格納した変数->prepare("SQL文");
//$変数->bindValue(id,'変化する値',PDO::データ型);
//idは:~があればそれを代入する。変化する値は具体的な値を代入する。
//$変数->execute();
//:~はプレースホルダーといいsql文の中でユーザーが入力する部分で使う。
//idはauto_incrementがあるので自動で追加順で番号が増えていく。

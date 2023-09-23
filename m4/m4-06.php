<?php
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザ名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$sql = "SELECT * FROM tbtest";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll();
foreach ($result as $row) {
    echo $row["id"] . ",";
    echo $row["name"] . ",";
    echo $row["comment"] . "<br>";
    echo "<hr>";
}
//fetch();とは、データベースの結果セットから1行分だけを取ってくるというものです。
//fetchAll();は、fetchメソッドと同じようにSQLの結果を取ってくるメソッドですが、
//1行ではなく全て(all)の行を一度に取ってくるメソッド
//今回の場合は$result=[[id:~, name:~, comment:~], [...], [...]]
//$row = [id:~, name:~, commet:~]

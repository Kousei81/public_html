<?php
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザ名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$sql = "SHOW CREATE TABLE tbtest";
$result = $pdo->query($sql);
foreach ($result as $row) {
    echo $row[1];
}
echo "<hr>";
//show create tableは指定したテーブルの作成時の条件を表示することができる。

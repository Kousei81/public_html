<?php
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザ名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = "SHOW TABLES";
$result = $pdo->query($sql);
foreach ($result as $row) {
    echo $row[0];
    echo "<br>";
}
echo "<hr>";
//show tablesはコマンド名、予約語とは違うことに気をつける。
//大文字と小文字に違いはないが、コマンドと予約語は大文字にする。
//show tablesはテーブルを表示させるコマンド。

<?php
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザ名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$id = 2;
$sql = 'delete from tbtest where id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$sql = "SELECT * FROM tbtest";
$stmt = $pdo -> query($sql);
$result = $stmt -> fetchAll();
foreach ($result as $row) {
    echo $row["id"].",";
    echo $row["name"].",";
    echo $row["comment"]."<br>";
    echo "<hr>";
}
//delete後のidはauto_incrementとかは関係ない。
//delete テーブル名 WHERE (条件);で削除できる。

<?php
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザ名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$id = 2;
$name = "みなと";
$comment = "こんにちは！"; 
$sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
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
//UPDATE テーブル名 SET (カラム名1) = (値1) WHERE (条件);で更新(編集)できる。
//カラムというのはテーブルの項目名のこと。

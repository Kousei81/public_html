<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>mission_5-1</title>
</head>

<body>

    <?php
    $dsn = 'mysql:dbname=データベース名;host=localhost';
    $user = 'ユーザ名';
    $sql_password = 'パスワード';
    $pdo = new PDO($dsn, $user, $sql_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $sql = "CREATE TABLE IF NOT EXISTS tbtest (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name char(32),
            comment TEXT,
            time timestamp,
            password varchar(32)
            )";
    //テーブル削除用
    //$sql = 'DROP TABLE tbtest';
    //$stmt = $pdo->query($sql);
    if (isset($_POST["formtype"])) {
        if ($_POST["formtype"] === "edit") {
            //編集する投稿の取得
            if (isset($_POST["edit_num"])) {
                $edit = $_POST["edit_num"];
                $edit_pass = $_POST["edit_pass"];
                $sql = 'SELECT * FROM tbtest';
                $stmt = $pdo->query($sql);
                $results = $stmt->fetchAll();
                foreach ($results as $row) {
                    //$rowの中にはテーブルのカラム名が入る
                    $postnum = $row['id'];
                    if ($edit_pass == $row['password']) {
                        if ($postnum == $edit) {
                            $name = $row['name'];
                            $str = $row['comment'];
                        }
                    } else {
                        $edit = NULL;
                    }
                }
            }
        }
    }
    ?>

    <form action="" method="post">
        <input type="text" name="name" value="<?php if (!empty($name)) {
                                                    echo $name;
                                                } else {
                                                    echo "名前";
                                                } ?>">
        <input type="text" name="comment" value="<?php if (!empty($str)) {
                                                        echo $str;
                                                    } else {
                                                        echo "コメント";
                                                    } ?>">
        <input type="text" name="password" value="パスワード">
        <input type="submit" name="submit" value="送信">
        <input type="hidden" name="formtype" value="post" checked="checked">
        <input type="text" name="check" value="<?php if (!empty($edit)) {
                                                    echo $edit;
                                                } ?>" checked="checked">
    </form>
    <form action="" method="post">
        <input type="number" name="del_num" value="削除対象番号">
        <input type="text" name="del_pass" value="パスワード">
        <input type="submit" name="delete" value="削除">
        <input type="hidden" name="formtype" value="delete" checked="checked">
    </form>
    <form action="" method="post">
        <input type="number" name="edit_num" value="編集対象番号">
        <input type="text" name="edit_pass" value="パスワード">
        <input type="submit" name="edit" value="編集">
        <input type="hidden" name="formtype" value="edit" checked="checked">
    </form>

    <?php
    if (isset($_POST["formtype"])) {
        $sql = "CREATE TABLE IF NOT EXISTS tbtest (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name char(32),
                comment TEXT,
                time timestamp,
                password varchar(32)
                )";
        $stmt = $pdo->query($sql);
        if ($_POST["formtype"] === "post") {
            //編集の処理
            $password = $_POST["password"];
            if (!empty($_POST["check"])) {
                $edit = $_POST["check"];
                $name = $_POST["name"];
                $str = $_POST["comment"];
                $sql = 'UPDATE tbtest SET name=:name,comment=:str WHERE id=:edit';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':str', $str, PDO::PARAM_STR);
                $stmt->bindParam(':edit', $edit, PDO::PARAM_INT);
                $stmt->execute();
            } else if (isset($_POST["name"]) && isset($_POST["comment"])) { //新規投稿の処理
                $name = $_POST["name"];
                $str = $_POST["comment"];
                $time = date("Y/m/d H:i:s");
                $sql = "INSERT INTO tbtest (name, comment, time, password) VALUES (:name, :str, :time, :password)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                $stmt->bindParam(":str", $str, PDO::PARAM_STR);
                $stmt->bindParam(":time", $time, PDO::PARAM_STR);
                $stmt->bindParam(":password", $password, PDO::PARAM_STR);
                $stmt->execute();
            }
        }

        if ($_POST["formtype"] === "delete") {
            //削除の処理
            if (isset($_POST["del_num"])) {
                $delete = $_POST["del_num"];
                $del_pass = $_POST["del_pass"];
                $sql = 'DELETE FROM tbtest WHERE id=:delete AND password=:del_pass';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':delete', $delete, PDO::PARAM_INT);
                $stmt->bindParam(':del_pass', $del_pass, PDO::PARAM_STR);
                $stmt->execute();
            }
        }

        //表示の処理
        $sql = 'SELECT * FROM tbtest';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row) {
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'] . ', ';
            echo $row['name'] . ', ';
            echo $row['comment'] . ', ';
            echo $row['time'] . ', ';
            echo $row['password'] . '<br>';
            echo "<hr>";
        }
    }
    //消すという動作は消すものを避けてそれ以外を表示するということ。
    //新規投稿　INSERT
    //編集　UPDATE
    //削除　DELETE
    ?>

</body>

</html>
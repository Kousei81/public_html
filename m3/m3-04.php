<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>mission_3-04</title>
</head>

<body>

    <?php
    $filename = "mission_3-4.txt";
    if (isset($_POST["formtype"])) {
        if ($_POST["formtype"] === "edit") {
            //編集する投稿の取得
            if (isset($_POST["edit_num"])) {
                $edit = $_POST["edit_num"];
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                for ($i = 0; $i < count($lines); $i++) {
                    $line = explode("<>", $lines[$i]);
                    $postnum = $line[0];
                    if ($postnum == $edit) {
                        $name = $line[1];
                        $str = $line[2];
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
        <input type="submit" name="submit" value="送信">
        <input type="hidden" name="formtype" value="post" checked="checked">
        <input type="hidden" name="check" value="<?php if (!empty($edit)) {
                                                        echo $edit;
                                                    } ?>" checked="checked">
    </form>
    <form action="" method="post">
        <input type="number" name="del_num" value="削除対象番号">
        <input type="submit" name="delete" value="削除">
        <input type="hidden" name="formtype" value="delete" checked="checked">
    </form>
    <form action="" method="post">
        <input type="number" name="edit_num" value="編集対象番号">
        <input type="submit" name="edit" value="編集">
        <input type="hidden" name="formtype" value="edit" checked="checked">
    </form>

    <?php
    $filename = "mission_3-4.txt";
    if (isset($_POST["formtype"])) {
        if ($_POST["formtype"] === "post") {
            //編集の処理
            if (!empty($_POST["check"])) {
                $edit = $_POST["check"];
                $name = $_POST["name"];
                $str = $_POST["comment"];
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                $fp = fopen($filename, "w");
                for ($i = 0; $i < count($lines); $i++) {
                    $line = explode("<>", $lines[$i]);
                    $postnum = $line[0];
                    if ($postnum == $edit) {
                        $time = $line[3];
                        $post = $postnum . "<>" . $name . "<>" . $str . "<>" . $time;
                        fwrite($fp, $post . PHP_EOL);
                    } else {
                        fwrite($fp, $lines[$i] . PHP_EOL);
                    }
                }
                fclose($fp);
            } else if (isset($_POST["name"]) && isset($_POST["comment"])) { //新規投稿の処理
                if (file_exists($filename)) {
                    $num = count(file($filename)) + 1;
                } else {
                    $num = 1;
                }
                $name = $_POST["name"];
                $str = $_POST["comment"];
                $time = date("Y/m/d H:i:s");
                $post = $num . "<>" . $name . "<>" . $str . "<>" . $time;
                $fp = fopen($filename, "a");
                fwrite($fp, $post . PHP_EOL);
                fclose($fp);
            }    
        } 

        if ($_POST["formtype"] === "delete") {
            //削除の処理
            if (isset($_POST["del_num"])) {
                $delete = $_POST["del_num"];
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                $fp = fopen($filename, "w");
                for ($i = 0; $i < count($lines); $i++) {
                    $line = explode("<>", $lines[$i]);
                    $postnum = $line[0];
                    if ($postnum != $delete) {
                        fwrite($fp, $lines[$i] . PHP_EOL);
                    }
                }
                fclose($fp);
            }
        }
    }

    if (file_exists($filename)) {
        //表示の処理
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            $element = explode("<>", $line);
            echo $element[0] . $element[1] . $element[2] . $element[3] . "<br>";
        }
    }
    //消すという動作は消すものを避けてそれ以外を表示するということ。
    ?>

</body>

</html>
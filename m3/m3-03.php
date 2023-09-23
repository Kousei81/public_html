<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>mission_3-03</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="name" value="名前">
        <input type="text" name="comment" value="コメント">
        <input type="submit" name="submit" value="送信">
        <input type="hidden" name="formtype" value="post" checked="checked">
    </form>
    <form action="" method="post">
        <input type="number" name="del_num" value="削除対象番号">
        <input type="submit" name="delete" value="削除">
        <input type="hidden" name="formtype" value="delete" checked="checked">
    </form>
    <?php
    $filename = "mission_3-3.txt";
    if (isset($_POST["formtype"])) {
        if ($_POST["formtype"] === "post") {
            //新規投稿の処理
            if (isset($_POST["name"]) && isset($_POST["comment"])) {
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